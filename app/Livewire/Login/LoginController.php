<?php

namespace App\Livewire\Login;

use App\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class LoginController extends Component
{
    use WithPagination;


    public function render()
    {
        $datas = collect(); // default kosong
        $datas = DB::table('tbl_mst_kategori')->get();
        return view('livewire.auth.index', [
            'datas' => $datas,
            'title' => 'Kategori',
        ])->extends('components.layouts.frontend.app');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',   // bisa email atau noreg
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'noreg';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials, true)) { // true = remember me 30 hari
            $request->session()->regenerate();
            return redirect()->intended('/track');
        }

        return back()->withErrors([
            'login' => 'Login gagal, periksa ' . $loginType . ' atau password.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        auth()->logout();                           // hapus auth
        $request->session()->invalidate();          // invalidate session
        $request->session()->regenerateToken();     // regenerate CSRF token

        return redirect('/login'); // arahkan ke halaman login
    }
}
