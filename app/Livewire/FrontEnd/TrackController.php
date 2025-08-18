<?php

namespace App\Livewire\FrontEnd;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TrackController extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 5; // Default items per page
    public $isReady = false; // penanda lazy load
    public $cart = [];
    protected $paginationTheme = 'bootstrap';
    public $filterType = 'request';
    protected $listeners = [
        'globalSearchUpdated',
        'reloadTable' => 'loadData',
        'reload-table' => '$refresh',
        'addToCart' => 'addToCart'
    ];
    public function globalSearchUpdated($value)
    {
        $this->search = $value;
    }

    public function setSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    public function setFilterType($type)
    {
        $this->filterType = $type;
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
                        ->orWhere('warna', 'like', '%' . $this->search . '%')
                    ;
                })->where('status', $this->filterType)
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage);
        }
        return view('livewire.front-end.track-controller', [
            'datas' => $datas,
        ])->extends('components.layouts.frontend.app');
    }
}
