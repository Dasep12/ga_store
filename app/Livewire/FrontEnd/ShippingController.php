<?php

namespace App\Livewire\Frontend;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function updateRemark($id, $remark)
    {
        if (isset($this->cart[$id])) {
            $this->cart[$id]['remark'] = $remark;
            session()->put('cart', $this->cart);
            $this->dispatch('cartUpdated');
        }
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

        if (!Auth::check()) {
            $this->dispatch('checkout-success', [
                'success' => false,
                'message' => 'Anda harus login dulu untuk request barang',
            ]);
            return;
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            $this->dispatch('checkout-success', [
                'success' => false,
                'message' => 'Daftar barang kosong, silakan tambahkan barang ke keranjang.',
            ]);
            return;
        }




        DB::beginTransaction();

        try {
            $emailService = app(EmailService::class);

            $userTypesSpecialOrder = Auth::user()->special_order;

            foreach ($cart as $items) {
                $productSpecialOrder = DB::table('tbl_mst_product')
                    ->where('id', $items['id_barang'])
                    ->value('special_order');

                // Jika produk special_order tapi user tidak special_order -> tolak
                if ($productSpecialOrder && !$userTypesSpecialOrder) {
                    $this->dispatch('checkout-success', [
                        'success' => false,
                        'message' => $items['nama_barang'] . ' (' . $items['kode_barang'] . ') hanya bisa diorder oleh user / department tertentu.',
                    ]);
                    return;
                }
            }
            // Generate order_id sekali untuk semua item
            $order_id = $this->generateOrderId();
            $items = [];
            foreach ($cart as $item) {
                $data = [
                    'order_id' => $order_id,
                    'product_id' => $item['id_barang'],
                    'remark' => $item['remark'],
                    'department_id' => Auth::user()->department_id,
                    'qty' => $item['qty'],
                    'qty_actual' => $item['qty'],
                    'status' => 'request',
                    'created_by' => Auth::user()->user_id, // Ganti dengan ID user yang sesuai
                    'updated_by' => Auth::user()->user_id, // Ganti dengan ID user yang sesuai
                    'user_id' => Auth::user()->user_id, // Ganti dengan ID user yang sesuai
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('tbl_trn_order')->insert($data);
                array_push($items, [
                    'nama' => $item['nama_barang'],
                    'qty' => $item['qty'],
                    'remark' => $item['remark'],
                    'images' => url($item['images']),
                ]);
            }



            $pengaju = [
                'nama' => Auth::user()->noreg . ' - ' .  ucwords(Auth::user()->nama),
                'departement' => DB::table('tbl_mst_department')
                    ->where('id', Auth::user()->department_id)
                    ->pluck('name')
                    ->first(),
                'tanggal' => now()->format('d/m/Y H:i:s'),
            ];

            $token = Hash::make($order_id . 'BTI');
            DB::table('tbl_mst_token')->insert([
                'order_id' => $order_id,
                'token' => $token,
                'status' => 'pending',
                'created_at' => now(),
            ]);


            $approvalList = DB::table('tbl_sys_users')->where([
                'department_id' => Auth::user()->department_id,
                'level_id' => 'A'
            ])->get();
            $emailList = [];
            foreach ($approvalList as $app) {
                $approveUrl = route('approval.approve', ['order_id' => $order_id, 'token' => $token, 'idx' => $app->user_id]);
                $rejectUrl  = route('approval.reject',  ['order_id' => $order_id, 'token' => $token, 'idx' => $app->user_id]);
                $emailService->sendApproval(
                    $items,
                    $app->email,
                    $approveUrl,
                    $rejectUrl,
                    $pengaju
                );
                $emailList[] = $app->email;
            }


            session()->forget('cart');
            $this->cart = [];
            $this->dispatch('checkout-success', [
                'message' => 'Checkout berhasil',
                'email'   => 'Data terkirim ke ' . implode(', ', $emailList),
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
                        'approved_by' => $req->idx, // Ganti dengan ID user yang sesuai
                        'updated_by' => $req->idx, // Ganti dengan ID user yang sesuai
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
                        'rejected_by' => Auth::user()->user_id, // Ganti dengan ID user yang sesuai
                        'updated_by' => Auth::user()->user_id, // Ganti dengan ID user yang sesuai
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


    public function PDFPermintaan($order_id)
    {
        $order = DB::table('vw_trn_order as o')
            ->where('o.order_id', $order_id)
            ->select(
                'o.*'
            )
            ->get();

        if ($order->isEmpty()) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('form.pdf-permintaan', ['order' => $order]);
        return $pdf->stream('permintaan_' . $order_id . '.pdf');
    }
}
