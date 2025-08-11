<?php

namespace App\Livewire\Product;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProductController extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10; // Default items per page
    public $isReady = false; // penanda lazy load
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['globalSearchUpdated'];
    public $filterStatus = 1;
    // public function updating($name, $value)
    // {
    //     if (in_array($name, ['search', 'perPage'])) {
    //         $this->resetPage();
    //     }
    // }

    // public function loadProducts()
    // {
    //     $this->isReady = true;
    // }

    // public function updatingPerPage()
    // {
    //     $this->resetPage(); // reset ke halaman 1 saat perPage berubah
    // }

    // public function render()
    // {
    //     $products = DB::table('tbl_mst_product')
    //         ->where('nama_barang', 'like', '%' . $this->search . '%')
    //         ->orWhere('kode_barang', 'like', '%' . $this->search . '%')
    //         ->paginate($this->perPage);

    //     return view('livewire.product.index', [
    //         'products' => $products
    //     ]);
    // }

    public function globalSearchUpdated($value)
    {
        $this->search = $value;
        // jalankan query/filter
    }


    public function setSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    public function loadProducts()
    {
        $this->isReady = true;
    }

    public function updating($name, $value)
    {
        if (in_array($name, ['search', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $products = collect(); // default kosong

        if ($this->isReady) {
            $products = DB::table('tbl_mst_product')
                ->where(function ($q) {
                    $q->where('nama_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('kode_barang', '=', '' . $this->search . '')
                        ->orWhere('is_active', 'like', '%' . $this->search . '%');
                })
                ->paginate($this->perPage);
        }

        return view('livewire.product.index', [
            'products' => $products
        ]);
    }
}
