<?php

namespace App\Livewire\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class MainController extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 25; // Default items per page
    public $isReady = false; // penanda lazy load
    public $cart = [];
    protected $paginationTheme = 'bootstrap';
    public $filterType = 'ALL';
    protected $listeners = [
        'globalSearchUpdated',
        'reloadTable' => 'loadData',
        'reload-table' => '$refresh',
        'addToCart' => 'addToCart'
    ];
    public $filterStatus = 1;
    public $message;
    public $selectedCategories = [];
    public $selectedType = [];
    public $selectedJenis = [];
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

    public function updatingSelectedJenis()
    {
        $this->resetPage();
    }
    public function updating($name, $value)
    {
        if (in_array($name, ['search', 'perPage', 'filterStatus', 'filterType'])) {
            $this->resetPage();
        }
    }

    public function mount()
    {
        // Ambil cart dari session saat component di-mount
        $this->cart = session()->get('cart', []);
    }

    public function addToCart($productId)
    {
        $cart = $this->cart;

        $cekStock = DB::table('tbl_trn_stock')->where('product_id', $productId)->first();
        if ($cekStock && $cekStock->stock < 1) {
            // Kirim event ke browser
            $this->dispatch('cart-added', [
                'status' => false,
                'message' => 'Stok barang habis, tidak dapat menambahkan ke keranjang',
            ]);
            return;
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['qty']++;
        } else {
            $product = DB::table('tbl_mst_product')->find($productId);
            $cart[$productId] = [
                'nama_barang' => $product->nama_barang,
                'kode_barang' => $product->kode_barang,
                'id_barang'    => $product->id,
                'type_barang' => $product->type_barang,
                'kategori_id' => $product->kategori_id,
                'images' => $product->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s',
                'qty' => 1
            ];
        }
        $this->cart = $cart;
        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        // Kirim event ke browser
        $this->dispatch('cart-added', [
            'message' => $cart[$productId]['nama_barang'] . ' berhasil ditambahkan ke keranjang',
            'status' => true,
            'data' => session()->get('cart')
        ]);
    }

    public function removeItem($id)
    {
        unset($this->cart[$id]);
        session()->put('cart', $this->cart);
    }

    public function render()
    {
        $datas = collect(); // default kosong

        if ($this->isReady) {
            $datas = DB::table('tbl_mst_product')
                ->leftJoin('tbl_mst_kategori', 'tbl_mst_product.kategori_id', '=', 'tbl_mst_kategori.id')
                ->leftJoin('tbl_mst_satuan', 'tbl_mst_product.satuan_id', '=', 'tbl_mst_satuan.id')
                ->leftJoin('tbl_mst_jenis_asset', 'tbl_mst_product.jenis_asset', '=', 'tbl_mst_jenis_asset.kode_asset')
                ->leftJoin('tbl_trn_stock', 'tbl_mst_product.id', '=', 'tbl_trn_stock.product_id')
                ->select(
                    'tbl_mst_product.*',
                    'tbl_mst_kategori.name as kategori_name',
                    'tbl_mst_satuan.name as satuan_name',
                    'tbl_mst_jenis_asset.name as jenis_asset_name',
                    'tbl_trn_stock.stock',
                    DB::raw('(SELECT COUNT(*) FROM tbl_trn_order WHERE tbl_trn_order.product_id = tbl_mst_product.id) as order_count')
                )->where(function ($q) {
                    $q->where('nama_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('tbl_mst_product.kode_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('type_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('merek', 'like', '%' . $this->search . '%')
                        ->orWhere('warna', 'like', '%' . $this->search . '%')
                        ->orWhere('tbl_mst_product.is_actived', 'like', '%' . $this->search . '%');
                })->when(count($this->selectedCategories) > 0, function ($q) {
                    $q->whereIn('kategori_id', $this->selectedCategories);
                })->when(count($this->selectedType) > 0, function ($q) {
                    $q->whereIn('type_barang', $this->selectedType);
                })->when(count($this->selectedJenis) > 0, function ($q) {
                    $q->whereIn('jenis_asset', $this->selectedJenis);
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
