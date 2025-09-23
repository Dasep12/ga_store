<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SysUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_sys_users';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'noreg',
        'password',
        'nama',
        'email',
        'department_id',
        'role_id',
        'level_id',
        'photo',
        'remember_token',
        'is_actived',
        'is_deleted'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
