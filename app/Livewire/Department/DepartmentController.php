<?php

namespace App\Livewire\Department;

use App\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10; // Default items per page
    public $isReady = false; // penanda lazy load
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['globalSearchUpdated', 'reloadTable' => 'loadData', 'reload-table' => '$refresh'];
    public $filterStatus = 1;
    public  $department_id, $name, $code, $is_actived, $created_at;
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



    public function loadData()
    {
        $this->isReady = true;
        $this->resetPage();
    }

    public function updating($name, $value)
    {
        if (in_array($name, ['search', 'perPage', 'filterStatus'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $datas = collect(); // default kosong

        if ($this->isReady) {
            $datas = DB::table('tbl_mst_department')
                ->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('code', 'like', '%' . $this->search . '%')
                        ->orWhere('is_actived', 'like', '%' . $this->search . '%');
                })->orderBy('created_at', 'desc')
                ->paginate($this->perPage);
        }

        return view('livewire.admin.department.index', [
            'datas' => $datas,
            'title' => 'Department',
        ])->extends('components.layouts.admin.app');
    }

    public function show($id)
    {
        $department = DB::table('tbl_mst_department')->find($id);
        return response()->json($department);
    }

    public function crudJson(Request $request)
    {

        switch ($request->crudAction) {
            case 'create':
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'code' => 'required|string|max:50|unique:tbl_mst_department,code',
                    'is_actived' => 'boolean'
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                DB::table('tbl_mst_department')->insert([
                    'name' => $request->name,
                    'code' => $request->code,
                    'is_actived' => (int)$request->is_actived ?? 0,
                    'created_by' => 'system',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return response()->json(['success' => true, 'message' => 'Data ditambahkan']);
                break;
            case 'edit':
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'code' => 'required|string|max:50|unique:tbl_mst_department,code,' . $request->id,
                    'is_actived' => 'boolean'
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                DB::table('tbl_mst_department')
                    ->where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'code' => $request->code,
                        'is_actived' => $request->is_actived ?? 0,
                        'updated_at' => now(),
                        'updated_by' => 'system',
                    ]);

                return response()->json(['success' => true, 'message' => 'Data diperbarui']);
                break;
            case 'delete':
                DB::table('tbl_mst_department')->where('id', $request->id)->delete();
                return response()->json(['success' => true, 'message' => 'Data dihapus']);
                break;
        }
    }

    public function exportExcel()
    {
        $exportService = new ExportService();

        $fileName = 'departments_' . now()->format('Ymd_His') . '.xlsx';

        $query = DB::table('tbl_mst_department')
            ->select('code', 'name', 'created_at', 'is_actived', 'created_by')
            ->orderBy('created_at', 'desc');

        return $exportService->export('query', $fileName, [
            'query' => $query,
            'columns' => ['code', 'name', 'created_at', 'is_actived', 'created_by'],
            'headings' => ['Kode', 'Nama', 'Tanggal Dibuat', 'Status Aktif', 'Dibuat Oleh'],
        ]);
    }
}
