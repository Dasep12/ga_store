<?php

namespace App\Livewire\Frontend;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\EmailService;
use Illuminate\Support\Facades\Hash;

class TrackController extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 5; // Default items per page
    public $isReady = false; // penanda lazy load
    public $cart = [];
    public $isResending = false;
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

    public function resendEmail($id)
    {
        DB::beginTransaction();
        $order_id = $id;
        $this->isResending = true;
        try {
            $emailService = app(EmailService::class);
            $pengaju = [
                'nama' => Auth::user()->noreg . ' - ' .  ucwords(Auth::user()->nama),
                'departement' => DB::table('tbl_mst_department')
                    ->where('id', Auth::user()->department_id)
                    ->pluck('name')
                    ->first(),
                'tanggal' => now()->format('d/m/Y H:i:s'),
            ];
            $items = [];
            $cart = DB::table('vw_trn_order')->where('order_id', $order_id)->get();
            foreach ($cart as $item) {
                array_push($items, [
                    'nama' => $item->nama_barang,
                    'qty'  => $item->qty,
                ]);
            }

            $token = Hash::make($order_id . 'BTI');
            DB::table('tbl_mst_token')->insert([
                'order_id' => $order_id,
                'token' => $token,
                'status' => 'pending',
                'created_at' => now(),
            ]);
            $approveUrl = route('approval.approve', ['order_id' => $order_id, 'token' => $token]);
            $rejectUrl  = route('approval.reject',  ['order_id' => $order_id, 'token' => $token]);

            $approvalList = DB::table('tbl_sys_users')->where([
                'department_id' => Auth::user()->department_id,
                'level_id' => 'A'
            ])->get();
            $emailList = [];
            foreach ($approvalList as $app) {
                $emailService->sendApproval(
                    $items,
                    $app->email,
                    $approveUrl,
                    $rejectUrl,
                    $pengaju
                );
                $emailList[] = $app->email;
            }

            DB::commit();
            $this->dispatch('checkout-success', [
                'message' => 'Email approval berhasil dikirim ke: ' . implode(', ', $emailList),
                'success' => true,
            ]);
            $this->isResending = false;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isResending = false;
            $this->dispatch('checkout-success', [
                'message' => 'Terjadi kesalahan saat resend email: ' . $e->getMessage(),
                'success' => false,
            ]);
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
                )->where('department_id', Auth::user()->department_id)
                ->where(function ($q) {
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
