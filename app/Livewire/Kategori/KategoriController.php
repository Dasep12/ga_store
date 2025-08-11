<?php

namespace App\Livewire\Kategori;

use App\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10; // Default items per page
    public $isReady = false; // penanda lazy load
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['globalSearchUpdated', 'reloadTable' => 'loadData', 'reload-table' => '$refresh'];
    public $filterStatus = 1;
    public  $kategori_id, $name,  $is_actived;
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
            $datas = DB::table('tbl_mst_kategori')
                ->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('is_actived', 'like', '%' . $this->search . '%');
                })->orderBy('created_at', 'desc')
                ->paginate($this->perPage);
        }

        return view('livewire.kategori.index', [
            'datas' => $datas,
            'title' => 'Kategori',
        ]);
    }

    public function show($id)
    {
        $Kategori = DB::table('tbl_mst_kategori')->find($id);
        return response()->json($Kategori);
    }

    public function crudJson(Request $request)
    {

        switch ($request->crudAction) {
            case 'create':
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'is_actived' => 'boolean'
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                DB::table('tbl_mst_kategori')->insert([
                    'name' => $request->name,
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
                    'is_actived' => 'boolean'
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                DB::table('tbl_mst_kategori')
                    ->where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'is_actived' => (int)$request->is_actived ?? 0,
                        'updated_at' => now(),
                        'updated_by' => 'system',
                    ]);

                return response()->json(['success' => true, 'message' => 'Data diperbarui']);
                break;
            case 'delete':
                DB::table('tbl_mst_kategori')->where('id', $request->id)->delete();
                return response()->json(['success' => true, 'message' => 'Data dihapus']);
                break;
        }
    }

    public function exportExcel()
    {
        $exportService = new ExportService();

        $fileName = 'kategori_' . now()->format('Ymd_His') . '.xlsx';

        $query = DB::table('tbl_mst_kategori')
            ->select('name', 'created_at', 'is_actived', 'created_by')
            ->orderBy('created_at', 'desc');

        return $exportService->export('query', $fileName, [
            'query' => $query,
            'columns' => ['name', 'created_at', 'is_actived', 'created_by'],
            'headings' => ['Nama', 'Tanggal Dibuat', 'Status', 'Dibuat Oleh'],
        ]);
    }
}
