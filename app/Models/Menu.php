<?php

// app/Models/Menu.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    protected $table = 'vw_usr_menu_access'; // nama tabel Anda
    protected $primaryKey = 'menu_id';
    public $incrementing = false; // karena pakai kode manual MN-xxxx
    protected $keyType = 'string';
    public $timestamps = true;

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_menu', 'menu_id')
            ->where('is_actived', 1)
            ->where('is_deleted', 0)
            ->where('role_id',Auth::user()->role_id)
            ->where('user_id',Auth::user()->user_id)
            ->orderBy('sort', 'asc');
    }
}
