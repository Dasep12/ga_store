<?php

use App\Models\Menu;

$menus = Menu::where('parent_menu', '*')
    ->where('is_actived', 1)
    ->where('is_deleted', 0)
    ->orderBy('sort', 'asc')
    ->with(['children.children.children']) // preload sampai level 4
    ->get();

function isActive($url)
{
    if (!$url) return '';
    return Request::is(trim($url, '/') . '*') ? 'active' : '';
}

?>

<nav class="navbar navbar-vertical navbar-expand-lg ">
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                @foreach ($menus as $menu)
                <li class="nav-item">
                    <div class="nav-item-wrapper">
                        @if ($menu->level == 'root')
                        <a class="nav-link label-1 {{ isActive($menu->url) }}"
                            href="{{ $menu->url ? url($menu->url) : '#' }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <span class="fa-solid fa-{{ $menu->icon }}"></span>
                                </span>
                                <span class="nav-link-text-wrapper">
                                    <span class="nav-link-text">{{ $menu->menu }}</span>
                                </span>
                            </div>
                        </a>
                        @else
                        <a class="nav-link dropdown-indicator label-1 {{ isActive($menu->url) }}"
                            href="#menu-{{ $menu->menu_id }}"
                            data-bs-toggle="collapse"
                            aria-expanded="{{ Request::is(trim($menu->url,'/').'*') ? 'true' : 'false' }}"
                            aria-controls="menu-{{ $menu->menu_id }}">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                    <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                @if($menu->icon)
                                <span class="nav-link-icon"><span data-feather="{{ $menu->icon }}"></span></span>
                                @endif
                                <span class="nav-link-text">{{ $menu->menu }}</span>
                            </div>
                        </a>
                        @endif

                        @if ($menu->children->count() > 0)
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent {{ Request::is(trim($menu->url,'/').'*') ? 'show' : '' }}"
                                id="menu-{{ $menu->menu_id }}">
                                @foreach ($menu->children as $submenu)
                                <li class="nav-item">
                                    @if ($submenu->children->count() > 0)
                                    <a class="nav-link dropdown-indicator {{ isActive($submenu->url) }}"
                                        href="#menu-{{ $submenu->menu_id }}"
                                        data-bs-toggle="collapse"
                                        aria-expanded="{{ Request::is(trim($submenu->url,'/').'*') ? 'true' : 'false' }}"
                                        aria-controls="menu-{{ $submenu->menu_id }}">
                                        <div class="d-flex align-items-center">
                                            <div class="dropdown-indicator-icon-wrapper">
                                                <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                                            </div>
                                            <span class="nav-link-text">{{ $submenu->menu }}</span>
                                        </div>
                                    </a>
                                    <div class="parent-wrapper">
                                        <ul class="nav collapse parent {{ Request::is(trim($submenu->url,'/').'*') ? 'show' : '' }}"
                                            id="menu-{{ $submenu->menu_id }}">
                                            @foreach ($submenu->children as $subsubmenu)
                                            <li class="nav-item">
                                                <a class="nav-link {{ isActive($subsubmenu->url) }}"
                                                    href="{{ $subsubmenu->url ? url($subsubmenu->url) : '#' }}">
                                                    <div class="d-flex align-items-center">
                                                        <span class="nav-link-text">{{ $subsubmenu->menu }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @else
                                    <a class="nav-link {{ isActive($submenu->url) }}"
                                        href="{{ $submenu->url ? url($submenu->url) : '#' }}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">{{ $submenu->menu }}</span>
                                        </div>
                                    </a>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="navbar-vertical-footer ">
        <button class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-8"></span><span class="uil uil-arrow-from-right fs-8"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span></button>
    </div>
</nav>