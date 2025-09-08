<?php

namespace App\Livewire\Stock;

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

class StockController extends Component
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
            $datas = DB::table('tbl_trn_stock')
                ->leftJoin('tbl_mst_product as b', 'b.id', '=', 'tbl_trn_stock.product_id')
                ->select(
                    'tbl_trn_stock.*',
                    'b.nama_barang',
                    'b.kode_barang',
                    'b.images',
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
        return view('livewire.admin.stock.index', [
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
}
