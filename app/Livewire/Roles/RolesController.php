<?php

namespace App\Livewire\Roles;

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

class RolesController extends Component
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
            $datas = DB::table('tbl_sys_role')
                ->select(
                    'tbl_sys_role.*',
                )->where(function ($q) {
                    $q->where('role_id', 'like', '%' . $this->search . '%')
                        ->orWhere('name_role', 'like', '%' . $this->search . '%')
                    ;
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage);
        }
        return view('livewire.admin.roles.index', [
            'datas' => $datas,
            'menu' => DB::table('tbl_sys_menu')->where('is_actived', 1)->orderBy('sort', 'ASC')->get(),
            'title' => 'User Management',
        ])->extends('components.layouts.admin.app');
    }

    public function show($id)
    {
        $data = DB::table('tbl_sys_role')->where('role_id', $id)->first();
        $menu = DB::table('tbl_sys_role_access')->where('role_id', $id)->get();
        return response()->json([$data, $menu]);
    }


    public function crudJson(Request $request)
    {
        DB::beginTransaction();

        $menu = $request->input('menuData', []);
        $menuData = json_decode($menu, true);
        switch ($request->crudAction) {
            case 'create':
                $validator = Validator::make($request->all(), [
                    'role_id' => 'required|string|max:255|unique:tbl_sys_role',
                    'name_role' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $message = "Data berhasil ditambahkan";
                DB::table('tbl_sys_role')->insert([
                    'name_role' => $request->name_role,
                    'role_id' => $request->role_id,
                    'created_by' => 'system',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('tbl_sys_role_access')->insert($menuData);
                break;
            case 'edit':
                $validator = Validator::make($request->all(), [
                    'role_id' => 'required|string|max:255|unique:tbl_sys_role,role_id,' . $request->id . ',role_id',
                    'name_role' => 'required|string|max:255',
                ]);
                DB::table('tbl_sys_role_access')->where('role_id', $request->role_id)->update(
                    [
                        'is_actived' => 0
                    ]
                );

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $message = "Data berhasil diupdate";
                DB::table('tbl_sys_role')->where('role_id', $request->id)->update([
                    'name_role' => $request->name_role,
                    'updated_at' => now(),
                    'updated_by' => 'system'
                ]);

                DB::table('tbl_sys_role_access')->upsert(
                    $menuData,
                    ['role_id', 'menu_id'], // kolom unik untuk penentuan replace
                    ['is_actived'] // kolom yang diupdate jika sudah ada
                );
                break;
            case 'delete':
                DB::table('tbl_sys_role_access')->where('role_id', $request->id)->delete();
                DB::table('tbl_sys_role')->where('role_id', $request->id)->delete();
                $message = "Data berhasil dihapus";
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
