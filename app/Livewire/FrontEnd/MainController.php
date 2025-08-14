<?php

namespace App\Livewire\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MainController extends Component
{
    use WithPagination;
    public $view = 'home';
    public $search = '';
    public $perPage = 25; // Default items per page
    public $isReady = false; // penanda lazy load
    protected $paginationTheme = 'bootstrap';
    public $filterType = 'ALL';
    protected $listeners = [
        'globalSearchUpdated',
        'reloadTable' => 'loadData',
        'reload-table' => '$refresh',
        'changeViewFromNavbar' => 'changeView'
    ];
    public $filterStatus = 1;
    public $message;
    public $selectedCategories = [];
    public $selectedType = [];
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

    public function updatingSelectedCategories()
    {
        $this->resetPage();
    }
    public function updatingSelectedType()
    {
        $this->resetPage();
    }
    public function updating($name, $value)
    {
        if (in_array($name, ['search', 'perPage', 'filterStatus', 'filterType'])) {
            $this->resetPage();
        }
    }

    public function changeView($view)
    {
        $this->view = null;
        $this->view = $view;
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
                })->when(count($this->selectedCategories) > 0, function ($q) {
                    $q->whereIn('kategori_id', $this->selectedCategories);
                })->when(count($this->selectedType) > 0, function ($q) {
                    $q->whereIn('type_barang', $this->selectedType);
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage);
        }

        return view('livewire.front-end.main', [
            'datas' => $datas,
            'categories' => DB::table('tbl_mst_kategori')->get(),
            'units' => DB::table('tbl_mst_satuan')->get(),
            'jenis_assets' => DB::table('tbl_mst_jenis_asset')->get(),
            'title' => 'Barang',
        ])->extends('components.layouts.frontend.app');
    }
}
