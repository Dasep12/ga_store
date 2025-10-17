<?php

namespace App\Livewire\Home;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeController extends Component
{
    protected string $layout = 'layouts.app';
    public function render()
    {

        return view('livewire.admin.home.index', [
            'title' => 'GA Store | Home'
        ])->extends('components.layouts.admin.app');
    }

    public function SumProduct()
    {
        $All = DB::table('vw_mst_product')->count();
        $Reguler = DB::table('vw_mst_product')->where('type_barang', 'Regular')->count();
        $NonReguler = DB::table('vw_mst_product')->where('type_barang', 'Non Regular')->count();

        return response()->json([
            'All' => $All,
            'Reguler' => $Reguler,
            'NonReguler' => $NonReguler,
            'Request' =>    DB::table('vw_trn_order')
                ->count()
        ]);
    }

    public function listRequestDepartment()
    {
        $data = DB::table('vw_trn_order')
            ->select('code_department', DB::raw('COUNT(*) as total_requests'))
            ->groupBy('code_department')
            ->get();

        return response()->json($data);
    }
    public function listOrder()
    {
        $data = DB::table('vw_trn_order as a')
            ->select('a.*')
            ->orderBy('a.created_at', 'DESC')
            ->limit(5)
            ->get();

        return response()->json($data);
    }
}
