<?php

namespace App\Livewire\AdjustStock;

use App\Imports\AdjustStocksImport;
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
use App\Services\MenuAccessService;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdjustStockController extends Component
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
            $datas = DB::table('vw_trn_adjust')
                ->leftJoin('vw_mst_product', 'vw_mst_product.id', '=', 'vw_trn_adjust.product_id')
                ->select(
                    'vw_trn_adjust.*',
                    'vw_mst_product.units'
                )->where(function ($q) {
                    $q->where('vw_trn_adjust.nama_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('vw_trn_adjust.kode_barang', 'like', '%' . $this->search . '%')
                    ;
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage);
        }

        $menuAccess = MenuAccessService::getAccess('MN-0003BC');
        $canCreate = $menuAccess->is_create;
        $canRead = $menuAccess->is_read;
        $canDelete = $menuAccess->is_delete;
        $canUpdate = $menuAccess->is_update;
        if ($canRead != 1) {
            return view('livewire.404', [
                'title' => 'Department',
            ])->extends('components.layouts.admin.app');
        }

        return view('livewire.admin.adjust-stock.index', [
            'datas' => $datas,
            'categories' => DB::table('tbl_mst_kategori')->get(),
            'units' => DB::table('tbl_mst_satuan')->get(),
            'jenis_assets' => DB::table('tbl_mst_jenis_asset')->get(),
            'produk'        => DB::table('tbl_mst_product')->get(),
            'title' => 'Adjust Stock',
            'canCreate' => $canCreate,
            'canRead' => $canRead,
            'canDelete' => $canDelete,
            'canUpdate' => $canUpdate,
        ])->extends('components.layouts.admin.app');
    }

    public function show($id)
    {
        $data = DB::table('vw_trn_adjust')->where('id', $id)->get();
        return response()->json($data);
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
                    'tanggal' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $message = "Data berhasil ditambahkan";
                DB::table('tbl_trn_adjust')->insert([
                    'product_id' => $request->product_id,
                    'kode_barang' => $request->kode_barang,
                    'qty' => $request->qty,
                    'type' => $request->type,
                    'tanggal' => $request->tanggal,
                    'remark' => $request->remark,
                    'created_by' => Auth::user()->user_id ?? 'system',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $qty =  (float)$request->qty;
                $type = $request->type;

                $existing = DB::table('tbl_trn_stock')
                    ->where('product_id', $request->product_id)
                    ->first();
                $stockAwal =  DB::table('tbl_trn_stock')
                    ->where('product_id', $request->product_id)
                    ->value('stock') ?? 0;
                $stokAkhir = 0;
                if ($existing) {
                    $stockBaru = $existing->stock + ($type === '+' ? $qty : -$qty);
                    $stokAkhir =  $stockBaru;
                    DB::table('tbl_trn_stock')
                        ->where('product_id', $request->product_id)
                        ->update([
                            'stock' => $stockBaru,
                            'updated_at' => now(),
                        ]);
                } else {
                    $stokAkhir = $request->qty;
                    DB::table('tbl_trn_stock')->insert([
                        'product_id' => $request->product_id,
                        'kode_barang' => $request->kode_barang,
                        'stock' => $request->qty,
                        'created_by' => Auth::user()->user_id ?? 'system',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('tbl_log_transaksi')->insert([
                    'product_id' => $request->product_id,
                    'kode_barang' => $request->kode_barang,
                    'qty' => $request->qty,
                    'created_by' => Auth::user()->user_id ?? 'system',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'stock_awal' => $stockAwal,
                    'stock_akhir' => $stokAkhir,
                    'type' => $type,
                    'name_process' => 'adjust',
                ]);
                break;
            case 'delete':
                $message = "Data berhasil dihapus";
                $operator = $request->type == '+' ? '-' : '+';
                $adjust = DB::table('tbl_trn_adjust')->where('id', $request->id)->first();

                if ($adjust) {
                    // tentukan arah pembalikan stok
                    $operator = $adjust->type == '+' ? '-' : '+';

                    // update stok kembali seperti sebelum adjustment dibuat
                    DB::table('tbl_trn_stock')->updateOrInsert(
                        ['product_id' => $adjust->product_id],
                        [
                            'stock' => DB::raw("stock {$operator} {$adjust->qty}"),
                            'created_by' => Auth::user()->user_id ?? 'system',
                            'updated_at' => now(),
                        ]
                    );

                    // hapus log adjust
                    DB::table('tbl_trn_adjust')->where('id', $adjust->id)->delete();
                }
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
        Excel::queueImport(new AdjustStocksImport($importId, $fullPath), $fullPath);

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
