<?php

namespace App\Livewire\Barang;

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
use App\Imports\ProductsImport;

class BarangController extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10; // Default items per page
    public $isReady = false; // penanda lazy load
    protected $paginationTheme = 'bootstrap';
    public $filterType = 'ALL';
    protected $listeners = ['globalSearchUpdated', 'reloadTable' => 'loadData', 'reload-table' => '$refresh'];
    public $filterStatus = 1;
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

        if ($this->isReady) {
            $datas = DB::table('tbl_mst_product')
                ->leftJoin('tbl_mst_kategori', 'tbl_mst_product.kategori_id', '=', 'tbl_mst_kategori.id')
                ->leftJoin('tbl_mst_satuan', 'tbl_mst_product.satuan', '=', 'tbl_mst_satuan.id')
                ->leftJoin('tbl_mst_jenis_asset', 'tbl_mst_product.jenis_asset', '=', 'tbl_mst_jenis_asset.kode_asset')
                ->select(
                    'tbl_mst_product.*',
                    'tbl_mst_kategori.name as kategori_name',
                    'tbl_mst_satuan.name as satuan_name',
                    'tbl_mst_jenis_asset.name as jenis_asset_name'
                )->where(function ($q) {
                    $q->where('nama_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('kode_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('type_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('merek', 'like', '%' . $this->search . '%')
                        ->orWhere('warna', 'like', '%' . $this->search . '%')
                        ->orWhere('tbl_mst_product.is_actived', 'like', '%' . $this->search . '%');
                })
                ->when($this->filterType !== 'ALL', function ($q) {
                    $q->where('type_barang', $this->filterType);
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage);
        }

        return view('livewire.admin.barang.index', [
            'datas' => $datas,
            'categories' => DB::table('tbl_mst_kategori')->get(),
            'units' => DB::table('tbl_mst_satuan')->get(),
            'jenis_assets' => DB::table('tbl_mst_jenis_asset')->get(),
            'title' => 'Barang',
        ])->extends('components.layouts.admin.app');
    }

    public function show($id)
    {
        $Kategori = DB::table('tbl_mst_product')->find($id);
        return response()->json($Kategori);
    }

    public function crudJson(Request $request)
    {
        switch ($request->crudAction) {
            case 'create':
                $validator = Validator::make($request->all(), [
                    'nama_barang' => 'required|string|max:255',
                    'kode_barang' => 'required|string|max:255|unique:tbl_mst_product,kode_barang',
                    'type_barang' => 'required|string|max:255',
                    'kategori_id' => 'required|string|max:255',
                    'satuan' => 'required|string|max:255',
                    'jenis_asset' => 'required|string|max:255',
                    'is_actived' => 'boolean',
                    'images'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                // Handle upload file jika ada
                $imagePath = null;
                if ($request->hasFile('images')) {
                    $file = $request->file('images');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('assets/images'), $filename);
                    $imagePath = 'assets/images/' . $filename; // simpan relative path
                }
                DB::table('tbl_mst_product')->insert([
                    'nama_barang' => $request->nama_barang,
                    'kode_barang' => $request->kode_barang,
                    'type_barang' => $request->type_barang,
                    'jenis_asset' => $request->jenis_asset,
                    'kategori_id' => $request->kategori_id,
                    'merek' => $request->merek,
                    'warna' => $request->warna,
                    'satuan' => $request->satuan,
                    'ukuran' => $request->ukuran,
                    'model' => $request->model,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'images'        => $imagePath,
                    'is_actived' => (int)$request->is_actived ?? 0,
                    'created_by' => 'system',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return response()->json(['success' => true, 'message' => 'Data ditambahkan']);
                break;
            case 'edit':
                $validator = Validator::make($request->all(), [
                    'images'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                $updateData = [
                    'nama_barang' => $request->nama_barang,
                    'kode_barang' => $request->kode_barang,
                    'type_barang' => $request->type_barang,
                    'jenis_asset' => $request->jenis_asset,
                    'kategori_id' => $request->kategori_id,
                    'merek' => $request->merek,
                    'warna' => $request->warna,
                    'satuan' => $request->satuan,
                    'ukuran' => $request->ukuran,
                    'model' => $request->model,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'is_actived'    => (int) ($request->is_actived ?? 0),
                    'updated_at'    => now(),
                    'updated_by'    => 'system',
                ];

                // Upload file jika ada
                if ($request->hasFile('images')) {
                    $file = $request->file('images');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('assets/images'), $filename);
                    $updateData['images'] = 'assets/images/' . $filename;
                }

                DB::table('tbl_mst_product')
                    ->where('id', $request->id)
                    ->update($updateData);
                return response()->json(['success' => true, 'message' => 'Data diperbarui']);
                break;
            case 'delete':
                DB::table('tbl_mst_product')->where('id', $request->id)->delete();
                return response()->json(['success' => true, 'message' => 'Data dihapus']);
                break;
        }
    }

    public function exportExcel()
    {
        $exportService = new ExportService();

        $fileName = 'barang_' . now()->format('Ymd_His') . '.xlsx';

        $query = DB::table('tbl_mst_product as a')
            ->leftJoin('tbl_mst_kategori as b', 'a.kategori_id', '=', 'b.id')
            ->leftJoin('tbl_mst_satuan as c', 'a.satuan', '=', 'c.id')
            ->leftJoin('tbl_mst_jenis_asset as d', 'a.jenis_asset', '=', 'd.kode_asset')
            ->select(
                'a.kode_barang',
                'a.nama_barang',
                'a.type_barang',
                'b.name as kategori_name',
                'c.name as satuan_name',
                'd.name as jenis_asset_name',
                'a.warna',
                'a.merek',
                'a.ukuran',
                'a.model',
                'a.harga',
                'a.deskripsi',
                'a.created_at',
                'a.is_actived',
                'a.created_by'
            )->orderBy('a.created_at', 'desc');

        return $exportService->export('query', $fileName, [
            'query' => $query,
            'columns' => ['kode_barang', 'nama_barang', 'type_barang', 'kategori_name', 'satuan_name', 'jenis_asset_name', 'warna', 'merek', 'ukuran', 'model', 'harga', 'deskripsi', 'created_at', 'is_actived', 'created_by'],
            'headings' => ['Kode Barang', 'Nama', 'Type', 'Kategori', 'Satuan', 'Jenis', 'Warna', 'Merek', 'Ukuran', 'Model', 'Harga', 'Deskripsi', 'Tanggal Dibuat', 'Status', 'Dibuat Oleh'],
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
        Excel::queueImport(new ProductsImport($importId, $fullPath), $fullPath);

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
