<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class MenuAccessService
{
    /**
     * Ambil akses menu untuk user dan role tertentu.
     * @param string $menuId
     * @return Menu|null
     */
    public static function getAccess($menuId)
    {
        $user = Auth::user();
        return Menu::where('menu_id', $menuId)
            ->where('role_id', $user->role_id)
            ->where('user_id', $user->user_id)
            ->first();
    }

    /**
     * Ambil semua akses menu user (array asosiatif menu_id => akses)
     * @return array
     */
    public static function getAllAccess()
    {
        $user = Auth::user();
        return Menu::where('role_id', $user->role_id)
            ->where('user_id', $user->user_id)
            ->get()
            ->keyBy('menu_id');
    }
}
