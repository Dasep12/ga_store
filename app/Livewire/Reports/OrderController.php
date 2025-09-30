<?php

namespace App\Livewire\Reports;

use App\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\MenuAccessService;
use Exception;

class OrderController extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10; // Default items per page
    public $isReady = false; // penanda lazy load
    public $barang = '';
    public $department = '';
    public $dates;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'reloadTable' => 'loadData',
    ];
    public $message;
    protected $queryString = ['barang', 'department', 'dates', 'perPage'];
    public function mount()
    {
        $this->dates = now()->format('m/d/Y') . ' - ' . now()->format('m/d/Y');
    }

    public function loadData()
    {
        $this->isReady = true;
        $this->resetPage();
    }

    public function barang(Request $request)
    {
        $search = $request->get('q'); // keyword dari Select2

        $query = DB::table('tbl_mst_product')
            ->select('id', 'nama_barang', 'kode_barang')
            ->limit(50);

        if (!empty($search)) {
            $query->where('nama_barang', 'like', '%' . $search . '%');
            $query->orWhere('kode_barang', 'like', '%' . $search . '%');
        }

        $data = $query->get();

        // Format untuk Select2
        $results = $data->map(function ($item) {
            return [
                'id'   => $item->id,
                'text' => $item->kode_barang . ' : ' . $item->nama_barang
            ];
        });

        return response()->json($results);
    }

    public function department(Request $request)
    {
        $search = $request->get('q'); // keyword dari Select2

        $query = DB::table('tbl_mst_department')
            ->select('id', 'name', 'code')
            ->limit(50);

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
            $query->orWhere('code', 'like', '%' . $search . '%');
        }

        $data = $query->get();

        // Format untuk Select2
        $results = $data->map(function ($item) {
            return [
                'id'   => $item->id,
                'text' => $item->code . ' : ' . $item->name
            ];
        });

        return response()->json($results);
    }

    public function filterData()
    {
        $this->resetPage();
    }

    public function render()
    {
        $datas = collect(); // default kosong


        // jika pakai lazy load
        if ($this->isReady) {
            $query  = DB::table('vw_trn_order')
                ->select(
                    'vw_trn_order.*',
                )
                ->whereIn('status', ['rejected', 'done'])
                ->orderBy('created_at', 'desc');
            if (!empty($this->department)) {
                $query->where('vw_trn_order.department_id', $this->department);
            }
            if (!empty($this->barang)) {
                $query->where('vw_trn_order.barang_id', $this->barang);
            }

            if (!empty($this->dates)) {
                $dates = explode(' - ', $this->dates);
                if (count($dates) == 2) {
                    $start = date('Y-m-d', strtotime($dates[0]));
                    $end = date('Y-m-d', strtotime($dates[1]));
                    $query->whereBetween('vw_trn_order.order_date', [$start, $end]);
                }
            }

            $datas = $query->paginate($this->perPage);
        }
        $menuAccess = MenuAccessService::getAccess('MN-0002AA');
        $canCreate = $menuAccess->is_create;
        $canRead = $menuAccess->is_read;
        $canDelete = $menuAccess->is_delete;
        $canUpdate = $menuAccess->is_update;
        if ($canRead != 1) {
            return view('livewire.404', [
                'title' => 'Roles',
            ])->extends('components.layouts.admin.app');
        }

        return view('livewire.admin.report.order', [
            'department' => DB::table('tbl_mst_department')->get(),
            'datas' => $datas,
            'canCreate' => $canCreate,
            'canRead' => $canRead,
            'canDelete' => $canDelete,
            'canUpdate' => $canUpdate,
            'title' => 'Report Order',
        ])->extends('components.layouts.admin.app');
    }


    public function exportExcel()
    {
        $exportService = new ExportService();

        $fileName = 'report_request_' . now()->format('Ymd_His') . '.xlsx';

        $query =  DB::table('vw_trn_order')
            ->select(
                'vw_trn_order.order_id',
                'vw_trn_order.order_date',
                'vw_trn_order.creator',
                'vw_trn_order.department',
                'vw_trn_order.type_barang',
                'vw_trn_order.nama_barang',
                'vw_trn_order.kode_barang',
                'vw_trn_order.satuan_name',
                'vw_trn_order.qty',
                'vw_trn_order.qty_actual',
                'vw_trn_order.status'
            )
            ->whereIn('status', ['rejected', 'done'])
            ->orderBy('created_at', 'desc');


        if (!empty($this->department)) {
            $query->where('vw_trn_order.department_id', $this->department);
        }
        if (!empty($this->barang)) {
            $query->where('vw_trn_order.barang_id', $this->barang);
        }

        if (!empty($this->dates)) {
            $dates = explode(' - ', $this->dates);
            if (count($dates) == 2) {
                $start = date('Y-m-d', strtotime($dates[0]));
                $end = date('Y-m-d', strtotime($dates[1]));
                $query->whereBetween('vw_trn_order.order_date', [$start, $end]);
            }
        }

        return $exportService->export('query', $fileName, [
            'query' => $query,
            'columns' => ['order_id', 'order_date', 'creator', 'department', 'type_barang', 'nama_barang', 'kode_barang', 'qty', 'qty_actual', 'status'],
            'headings' => ['Order ID', 'Order Date', 'Creator', 'Department', 'Tipe Barang', 'Nama Barang', 'Kode Barang', 'Unit', 'Qty', 'Qty Actual', 'Status'],
        ]);
    }
}
