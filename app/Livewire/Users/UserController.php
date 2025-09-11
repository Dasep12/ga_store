<?php

namespace App\Livewire\Users;

use App\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Imports\StocksImport;
use Exception;

class UserController extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10; // Default items per page
    public $isReady = false; // penanda lazy load
    protected $paginationTheme = 'bootstrap';
    public $filterType = 'ALL'; // default filter
    public $filterStatus = 'request'; // default filter status
    protected $listeners = ['globalSearchUpdated', 'reloadTable' => 'loadData', 'reload-table' => '$refresh'];
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


    public function setFilterStatus($type)
    {
        $this->filterStatus = $type;
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


        // jika pakai lazy load
        if ($this->isReady) {
            $datas = DB::table('tbl_sys_users')
                ->leftJoin('tbl_mst_department', 'tbl_mst_department.id', '=', 'tbl_sys_users.department_id')
                ->leftJoin('tbl_sys_role', 'tbl_sys_role.role_id', '=', 'tbl_sys_users.role_id')
                ->leftJoin('tbl_mst_level', 'tbl_mst_level.level_id', '=', 'tbl_sys_users.level_id')
                ->select(
                    'tbl_sys_users.*',
                    'tbl_mst_level.name as level_name',
                    'tbl_mst_department.name as department_name',
                    'tbl_sys_role.name_role as role_name',
                )->where(function ($q) {
                    $q->where('noreg', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('nama', 'like', '%' . $this->search . '%')
                    ;
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage);
        }
        return view('livewire.admin.users.index', [
            'datas' => $datas,
            'departments' => DB::table('tbl_mst_department')->get(),
            'roles' => DB::table('tbl_sys_role')->get(),
            'levels' => DB::table('tbl_mst_level')->get(),
            'title' => 'User Management',
        ])->extends('components.layouts.admin.app');
    }

    public function show($id)
    {
        $data = DB::table('tbl_sys_users')->where('id', $id)->get();
        return response()->json($data);
    }


    public function crudJson(Request $request)
    {
        DB::beginTransaction();
        switch ($request->crudAction) {
            case 'create':
                $validator = Validator::make($request->all(), [
                    'noreg' => 'required|string|max:255|unique:tbl_sys_users',
                    'email' => 'required|string|max:255|unique:tbl_sys_users',
                    'nama' => 'required|string|max:255',
                    'password'         => 'required|string|max:255',
                    'level_id' => 'required|string|max:255',
                    'department_id' => 'required|string|max:255',
                    'role_id' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $message = "Data berhasil ditambahkan";
                DB::table('tbl_sys_users')->insert([
                    'noreg' => $request->noreg,
                    'email' => $request->email,
                    'nama' => $request->nama,
                    'level_id' => $request->level_id,
                    'password' => $request->password,
                    'department_id' => $request->department_id,
                    'role_id' => $request->role_id,
                    'created_by' => 'system',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                break;
            case 'edit':
                $validator = Validator::make($request->all(), [
                    'noreg' => 'required|string|max:255|unique:tbl_sys_users,noreg,' . $request->id . ',id',
                    'email' => 'required|string|max:255|unique:tbl_sys_users,email,' . $request->id . ',id',
                    'nama' => 'required|string|max:255',
                    'department_id' => 'required|string|max:255',
                    'role_id' => 'required|string|max:255',
                ]);


                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $message = "Data berhasil diupdate";
                DB::table('tbl_sys_users')->where('id', $request->id)->update([
                    'noreg' => $request->noreg,
                    'email' => $request->email,
                    'nama' => $request->nama,
                    'level_id' => $request->level_id,
                    'department_id' => $request->department_id,
                    'role_id' => $request->role_id,
                    'updated_at' => now(),
                    'updated_by' => 'system'
                ]);
                break;
            case 'delete':
                $message = "Data berhasil dihapus";
                DB::table('tbl_sys_users')->where('id', $request->id)->delete();
                break;
        }

        try {
            DB::commit();
            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function exportExcel()
    {
        $exportService = new ExportService();

        $fileName = 'users_' . now()->format('Ymd_His') . '.xlsx';

        $query =  DB::table('tbl_sys_users as a')
            ->leftJoin('tbl_mst_department as b', 'b.id', '=', 'a.department_id')
            ->leftJoin('tbl_sys_role as c', 'c.role_id', '=', 'a.role_id')
            ->leftJoin('tbl_mst_level as d', 'd.level_id', '=', 'a.level_id')
            ->select(
                'a.noreg',
                'a.nama',
                'a.email',
                'c.name_role',
                'b.name as department_name',
                'd.name as level_name',
            )->orderBy('a.created_at', 'desc');

        return $exportService->export('query', $fileName, [
            'query' => $query,
            'columns' => ['noreg', 'nama', 'email', 'name_role', 'department_name', 'level_name'],
            'headings' => ['Noreg', 'Name', 'Email', 'Role', 'Department', 'Level'],
        ]);
    }
}
