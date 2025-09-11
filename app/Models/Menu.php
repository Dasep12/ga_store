<?php

// app/Models/Menu.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'tbl_sys_menu'; // nama tabel Anda
    protected $primaryKey = 'menu_id';
    public $incrementing = false; // karena pakai kode manual MN-xxxx
    protected $keyType = 'string';
    public $timestamps = true;

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_menu', 'menu_id')
            ->where('is_actived', 1)
            ->where('is_deleted', 0)
            ->orderBy('sort', 'asc');
    }
}
