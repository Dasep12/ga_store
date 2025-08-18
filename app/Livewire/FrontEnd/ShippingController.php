<?php

namespace App\Livewire\FrontEnd;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShippingController extends Component
{
    public $cart = [];

    public function getListeners()
    {
        return [
            'cartUpdated' => 'refreshCart'
        ];
    }

    public function render()
    {

        return view('livewire.front-end.shipping-controller', [
            'cart' => session()->get('cart'), // Retrieve cart from session
        ])->extends('components.layouts.frontend.app');
    }


    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }


    public function increamentQuantity($id)
    {
        if (isset($this->cart[$id])) {
            $this->cart[$id]['qty']++;
            session()->put('cart', $this->cart);
            $this->dispatch('cartUpdated');
        }
    }

    public function decreamentQuantity($id)
    {
        if (isset($this->cart[$id]) && $this->cart[$id]['qty'] > 1) {
            $this->cart[$id]['qty']--;
            session()->put('cart', $this->cart);
            $this->dispatch('cartUpdated');
        }
    }

    public function updatedCart($value, $key)
    {
        [$id, $field] = explode('.', $key);
        if ($field === 'qty') {
            $qty = (int) $value;
            if ($qty < 1) {
                $this->cart[$id]['qty'] = 1;
            }
            session()->put('cart', $this->cart); // Tambahkan baris ini
            $this->dispatch('cartUpdated');
        }
    }


    public function refreshCart()
    {
        $this->cart = session()->get('cart', []);
    }

    public function removeItem($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        $this->cart = $cart;
    }


    public function generateOrderId()
    {
        $last = DB::table('tbl_trn_order')
            ->where('order_id', 'like', 'ORDER-%')
            ->selectRaw('MAX(CAST(SUBSTRING(order_id, 7) AS UNSIGNED)) as last_number')
            ->first();

        $nextNumber = $last && $last->last_number ? $last->last_number + 1 : 1;
        return 'ORDER-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }

    public function checkOut()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            $this->dispatch('checkout-success', [
                'message' => 'Daftar barang kosong, silakan tambahkan barang ke keranjang.',
            ]);
            return;
        }

        DB::beginTransaction();

        try {
            // Cek dan kunci stok semua item dulu
            foreach ($cart as $item) {
                $stock = DB::table('tbl_trn_stock')
                    ->where('product_id', $item['id_barang'])
                    ->lockForUpdate()
                    ->value('stock');

                if ($stock === null || $stock < $item['qty']) {
                    DB::rollBack();
                    $this->dispatch('checkout-success', [
                        'message' => 'Stok barang ' . $item['nama_barang'] . ' tidak mencukupi!',
                    ]);
                    return;
                }
            }

            // Generate order_id sekali untuk semua item
            $order_id = $this->generateOrderId();

            foreach ($cart as $item) {
                $data = [
                    'order_id' => $order_id,
                    'product_id' => $item['id_barang'],
                    'department_id' => 1,
                    'qty' => $item['qty'],
                    'user_id' => 1, // Ganti dengan ID user yang sesuai
                    'status' => 'request'
                ];
                DB::table('tbl_trn_order')->insert($data);

                // Potong stok
                DB::table('tbl_trn_stock')
                    ->where('product_id', $item['id_barang'])
                    ->decrement('stock', $item['qty']);
            }

            DB::commit();
            $this->dispatch('checkout-success', [
                'message' => 'Checkout berhasil',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('checkout-success', [
                'message' => 'Terjadi kesalahan saat checkout: ' . $e->getMessage(),
            ]);
        }
    }
}
