<?php

namespace App\Livewire\InputStock;

use App\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Imports\StocksImport;
use Exception;

class InputStockController extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10; // Default items per page
    public $isReady = false; // penanda lazy load
    protected $paginationTheme = 'bootstrap';
    public $filterType = 'ALL'; // default filter
    public $filterStatus = 'request'; // default filter status
    protected $listeners = ['globalSearchUpdated', 'reloadTable' => 'loadData', 'reload-table' => '$refresh'];
    public $message;
    public function globalSearchUpdated($value)
    {
        $this->search = $value;
    }

    public function setSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }


    public function setFilterStatus($type)
    {
        $this->filterStatus = $type;
        $this->resetPage();
        $this->loadData(); // jika pakai lazy load
    }


    public function loadData()
    {
        $this->isReady = true;
        $this->resetPage();
    }

    public function updating($name, $value)
    {
        if (in_array($name, ['search', 'perPage', 'filterStatus', 'filterType'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $datas = collect(); // default kosong


        // jika pakai lazy load
        if ($this->isReady) {
            $datas = DB::table('vw_trn_beli')
                ->select(
                    'vw_trn_beli.*'
                )->where(function ($q) {
                    $q->where('nama_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('kode_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('type_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('merek', 'like', '%' . $this->search . '%')
                    ;
                })
                ->when($this->filterType !== 'ALL', function ($q) {
                    $q->where('type_barang', $this->filterType);
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage);
        }
        return view('livewire.admin.input-stock.index', [
            'datas' => $datas,
            'categories' => DB::table('tbl_mst_kategori')->get(),
            'units' => DB::table('tbl_mst_satuan')->get(),
            'jenis_assets' => DB::table('tbl_mst_jenis_asset')->get(),
            'produk'        => DB::table('tbl_mst_product')->get(),
            'title' => 'Input Stock',
        ])->extends('components.layouts.admin.app');
    }

    public function show($id)
    {
        $data = DB::table('vw_trn_beli')->where('transaction_id', $id)->get();
        return response()->json($data);
    }

    public function generateBeliId()
    {
        $last = DB::table('tbl_trn_beli')
            ->where('transaction_id', 'like', 'BELI_%')
            ->selectRaw('MAX(CAST(SUBSTRING(transaction_id, 7) AS UNSIGNED)) as last_number')
            ->first();

        $nextNumber = $last && $last->last_number ? $last->last_number + 1 : 1;
        return 'BELI_' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }

    public function crudJson(Request $request)
    {
        DB::beginTransaction();
        switch ($request->crudAction) {
            case 'create':
                $validator = Validator::make($request->all(), [
                    'product_id' => 'required|string|max:255',
                    'kode_barang' => 'required|string|max:255',
                    'qty'         => 'required|string|max:255',
                    'tanggal_beli' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $message = "Data berhasil ditambahkan";
                DB::table('tbl_trn_beli')->insert([
                    'transaction_id' => self::generateBeliId(),
                    'no_po' => $request->no_po,
                    'tanggal_beli' => $request->tanggal_beli,
                    'product_id' => $request->product_id,
                    'qty' => $request->qty,
                    'harga_satuan' => $request->harga_satuan,
                    'supplier' => $request->supplier,
                    'harga_total' => $request->harga_total,
                    'status' => 'done',
                    'remark' => $request->remark,
                    'created_by' => 'system',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $existing = DB::table('tbl_trn_stock')
                    ->where('product_id', $request->product_id)
                    ->first();

                if ($existing) {
                    DB::table('tbl_trn_stock')
                        ->where('product_id', $request->product_id)
                        ->update([
                            'stock' => $existing->stock + $request->qty,
                            'updated_at' => now(),
                        ]);
                } else {
                    DB::table('tbl_trn_stock')->insert([
                        'product_id' => $request->product_id,
                        'stock' => $request->qty,
                        'created_by' => 'system',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                break;
            case 'delete':
                $message = "Data berhasil dihapus";
                DB::table('tbl_trn_beli')->where('transaction_id', $request->transaction_id)->delete();
                DB::table('tbl_trn_stock')->updateOrInsert(
                    ['product_id' => $request->product_id], // kondisi
                    [
                        'stock' => DB::raw("stock - {$request->qty}"), // update stock nambah
                        'created_by' => 'system',
                        'updated_at' => now(),
                    ]
                );
                break;
        }

        try {
            DB::commit();
            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function exportExcel()
    {
        $exportService = new ExportService();

        $fileName = 'stock_' . now()->format('Ymd_His') . '.xlsx';

        $query = DB::table('tbl_trn_beli as a')
            ->leftJoin('tbl_mst_product as e', 'e.id', '=', 'a.product_id')
            ->select(
                'e.nama_barang',
                'e.kode_barang',
                'a.qty',
                'a.harga_satuan',
                'a.harga_total',
                'a.no_po',
                'a.tanggal_beli',
                'a.supplier',
                'a.remark',
            )->orderBy('a.created_at', 'desc');

        return $exportService->export('query', $fileName, [
            'query' => $query,
            'columns' => ['nama_barang', 'kode_barang', 'qty', 'harga_satuan', 'harga_total', 'no_po', 'tanggal_beli', 'supplier', 'remark'],
            'headings' => ['Nama Barang', 'Kode', 'Qty', 'Harga Satuan', 'Harga Total', 'NO PO', 'Tanggal Beli', 'Supplier', 'Remark'],
        ]);
    }

    public function ImportExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240'
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('imports', $filename); // storage/app/imports/...

        $fullPath = storage_path('app/' . $path);

        // Dapatkan jumlah baris dengan cepat tanpa memuat seluruh workbook:
        $reader = IOFactory::createReaderForFile($fullPath);
        $worksheetInfo = $reader->listWorksheetInfo($fullPath);
        // ambil sheet pertama info
        $totalRows = $worksheetInfo[0]['totalRows'] ?? 0;

        // Buat ID import unik
        $importId = (string) Str::uuid();

        // Simpan metadata progress di cache
        Cache::put("import:{$importId}:total", max(0, $totalRows - 1)); // jika header satu baris, bisa -1
        Cache::put("import:{$importId}:processed", 0);
        Cache::put("import:{$importId}:status", 'queued');

        // Queue import menggunakan Laravel-Excel (yang mendukung ShouldQueue)
        // ProductsImport harus menerima $importId dan $path
        Excel::queueImport(new StocksImport($importId, $fullPath), $fullPath);

        return response()->json([
            'success' => true,
            'import_id' => $importId,
            'message' => 'File diunggah. Import sedang diproses.'
        ]);
    }

    public function progress($id)
    {
        $total = Cache::get("import:{$id}:total", null);
        $processed = Cache::get("import:{$id}:processed", 0);
        $status = Cache::get("import:{$id}:status", 'unknown');

        $percent = null;
        if ($total !== null && $total > 0) {
            $percent = round(($processed / $total) * 100, 2);
            if ($percent > 100) $percent = 100;
        } elseif ($status === 'finished') {
            $percent = 100;
        }

        return response()->json([
            'status' => $status,
            'total' => $total,
            'processed' => $processed,
            'percent' => $percent
        ]);
    }
}
