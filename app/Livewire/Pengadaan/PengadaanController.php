<?php

namespace App\Livewire\Pengadaan;

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

class PengadaanController extends Component
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

        if ($this->isReady) {
            $datas = DB::table('vw_trn_order')
                ->select(
                    'vw_trn_order.*',
                    DB::raw('(SELECT COUNT(*) FROM tbl_trn_order WHERE tbl_trn_order.product_id = vw_trn_order.barang_id) as order_count')
                )->where(function ($q) {
                    $q->where('nama_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('kode_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('type_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('merek', 'like', '%' . $this->search . '%')
                        ->orWhere('department', 'like', '%' . $this->search . '%')
                    ;
                })->where('status', $this->filterStatus)
                ->when($this->filterType !== 'ALL', function ($q) {
                    $q->where('type_barang', $this->filterType);
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage);
        }

        return view('livewire.admin.pengadaan.index', [
            'datas' => $datas,
            'title' => 'Pengadaan',
        ])->extends('components.layouts.admin.app');
    }

    public function show($id)
    {
        $data = DB::table('vw_trn_order')->where('order_id', $id)->get();
        return response()->json($data);
    }

    public function crudJson(Request $request)
    {
        switch ($request->crudAction) {
            case 'create':
                return response()->json(['success' => true, 'message' => 'Data ditambahkan']);
                break;
            case 'edit':
                return response()->json(['success' => true, 'message' => 'Data diperbarui']);
                break;
            case 'delete':
                DB::table('tbl_mst_product')->where('id', $request->id)->delete();
                return response()->json(['success' => true, 'message' => 'Data dihapus']);
                break;
            case 'process':
                // Proses pengadaan, misalnya update status atau lainnya
                DB::table('tbl_trn_order')->where('id', $request->id)->update([
                    'status' => 'progress',
                    'progress_by' => 'dasep',
                    'progress_date' => now(),
                ]);
                return response()->json(['success' => true, 'message' => 'Request Barang terproses']);
                break;
            case 'done':
                // Proses pengadaan, misalnya update status atau lainnya
                DB::table('tbl_trn_order')->where('id', $request->id)->update([
                    'status' => 'done',
                    'finish_by' => 'dasep',
                    'finish_date' => now(),
                ]);
                return response()->json(['success' => true, 'message' => 'Data dihapus']);
                break;
            case 'reject':
                // Proses pengadaan, misalnya update status atau lainnya
                DB::table('tbl_trn_order')->where('id', $request->id)->update([
                    'status' => 'rejected',
                    'finish_by' => 'dasep',
                    'finish_date' => now(),
                ]);
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
}
