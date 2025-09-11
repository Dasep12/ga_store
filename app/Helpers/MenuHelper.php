<?php

namespace App\Helpers;

class MenuHelper
{
    public static function buildMenuTree($menus, $parent = '*')
    {
        $branch = [];
        foreach ($menus as $menu) {
            if ($menu->parent_menu === $parent) {
                $children = self::buildMenuTree($menus, $menu->menu_id);
                if ($children) {
                    $menu->children = $children;
                }
                $branch[] = $menu;
            }
        }
        return $branch;
    }
}
