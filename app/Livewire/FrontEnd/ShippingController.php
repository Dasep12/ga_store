<?php

namespace App\Livewire\Frontend;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
            $emailService = app(EmailService::class);
            // Cek dan kunci stok semua item dulu
            // foreach ($cart as $item) {
            //     $stock = DB::table('tbl_trn_stock')
            //         ->where('product_id', $item['id_barang'])
            //         ->lockForUpdate()
            //         ->value('stock');

            //     if ($stock === null || $stock < $item['qty']) {
            //         DB::rollBack();
            //         $this->dispatch('checkout-success', [
            //             'message' => 'Stok barang ' . $item['nama_barang'] . ' tidak mencukupi!',
            //         ]);
            //         return;
            //     }
            // }

            // Generate order_id sekali untuk semua item
            $order_id = $this->generateOrderId();
            $items = [];
            foreach ($cart as $item) {
                $data = [
                    'order_id' => $order_id,
                    'product_id' => $item['id_barang'],
                    'department_id' => 1,
                    'qty' => $item['qty'],
                    'qty_actual' => $item['qty'],
                    'user_id' => 1, // Ganti dengan ID user yang sesuai
                    'status' => 'request',
                    'created_at' => now(),
                    'created_by' => 1, // Ganti dengan ID user yang sesuai
                    'updated_at' => now(),
                    'updated_by' => 1, // Ganti dengan ID user yang sesuai
                ];
                DB::table('tbl_trn_order')->insert($data);
                array_push($items, [
                    'nama' => $item['nama_barang'],
                    'qty' => $item['qty'],
                ]);
                // // Potong stok
                // DB::table('tbl_trn_stock')
                //     ->where('product_id', $item['id_barang'])
                //     ->decrement('stock', $item['qty']);
            }


            $pengaju = [
                'nama' => 'Dasep Depiyawan',
                'departemen' => 'IT',
                'tanggal' => now()->format('d/m/Y'),
            ];
            $token = Hash::make($order_id . 'BTI');
            DB::table('tbl_mst_token')->insert([
                'order_id' => $order_id,
                'token' => $token,
                'status' => 'pending',
                'created_at' => now(),
            ]);
            $approveUrl = route('approval.approve', ['order_id' => $order_id, 'token' => $token]);
            $rejectUrl  = route('approval.reject',  ['order_id' => $order_id, 'token' => $token]);
            $emailService->sendApproval(
                $items,
                'dasepdepiyawan@outlook.com',
                $approveUrl,
                $rejectUrl,
                $pengaju
            );

            session()->forget('cart');
            $this->cart = [];
            $this->dispatch('checkout-success', [
                'message' => 'Checkout berhasil',
                'success' => true,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('checkout-success', [
                'message' => 'Terjadi kesalahan saat checkout: ' . $e->getMessage(),
                'success' => false,
            ]);
        }
    }

    public function approveOrder(Request $req)
    {
        $record = DB::table('tbl_mst_token')
            ->where('order_id', $req->order_id)
            ->where('token', $req->token)
            ->where('status', 'pending')
            ->first();
        $message  = '';
        $error = true;

        try {

            if (!$record) {
                $error = true;
                $message = 'Token atau Order ID tidak valid atau sudah digunakan';
            } else {
                //update status token
                DB::table('tbl_mst_token')
                    ->where('order_id', $req->order_id)
                    ->where('token', $req->token)
                    ->update([
                        'status' => 'approved',
                        'updated_at' => now(),
                    ]);
                //update status order
                DB::table('tbl_trn_order')
                    ->where('order_id', $req->order_id)
                    ->update([
                        'status' => 'approved',
                        'updated_at' => now(),
                        'approved_date' => now(),
                        'approved_by' => 1, // Ganti dengan ID user yang sesuai
                        'updated_by' => 1, // Ganti dengan ID user yang sesuai
                    ]);
                $message = 'Request dengan ID ' . $req->order_id . ' telah disetujui.';
                $error = false;
            }
        } catch (\Exception $e) {
            $error = true;
            $message = 'Terjadi kesalahan: ' . $e->getMessage();
        }

        return view('livewire.front-end.approve-notification', [
            'message' => $message,
            'error' => $error,
        ])
            ->extends('components.layouts.frontend.app');
        //validasi token dan order_id


    }

    public function rejectOrder(Request $req)
    {
        //validasi token dan order_id
        $record = DB::table('tbl_mst_token')
            ->where('order_id', $req->order_id)
            ->where('token', $req->token)
            ->where('status', 'pending')
            ->first();
        $message  = '';
        $error = true;
        try {
            if (!$record) {
                $error = true;
                $message = 'Token atau Order ID tidak valid atau sudah digunakan';
            } else {
                //update status token
                DB::table('tbl_mst_token')
                    ->where('order_id', $req->order_id)
                    ->where('token', $req->token)
                    ->update([
                        'status' => 'rejected',
                        'updated_at' => now(),
                    ]);
                //update status order
                DB::table('tbl_trn_order')
                    ->where('order_id', $req->order_id)
                    ->update([
                        'status' => 'rejected',
                        'updated_at' => now(),
                        'rejected_date' => now(),
                        'rejected_by' => 1, // Ganti dengan ID user yang sesuai
                        'updated_by' => 1, // Ganti dengan ID user yang sesuai
                    ]);
                $error = false;
                $message = 'Request dengan ID ' . $req->order_id . ' di tolak.';
            }
        } catch (\Exception $e) {
            $error = true;
            $message = 'Terjadi kesalahan: ' . $e->getMessage();
        }
        return view('livewire.front-end.reject-notification', [
            'message' => $message,
            'error' => $error,
        ])->extends('components.layouts.frontend.app');
    }
}
