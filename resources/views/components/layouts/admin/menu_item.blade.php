<li class="nav-item">
    <div class="nav-item-wrapper">
        @if($menu->url)
        {{-- Jika ada url langsung buat link --}}
        <a class="nav-link" href="{{ url($menu->url) }}">
            <div class="d-flex align-items-center">
                @if($menu->icon)

                <span class="nav-link-icon"><i class="fa fa-{{ $menu->icon }}"></i></span>
                @endif
                <span class="nav-link-text">{{ $menu->menu }}</span>
            </div>
        </a>
        @else
        {{-- Jika tidak ada url, buat dropdown --}}
        <a class="nav-link dropdown-indicator" href="#{{ $menu->menu_id }}" data-bs-toggle="collapse" aria-expanded="false" aria-controls="{{ $menu->menu_id }}">

            <div class="d-flex align-items-center">
                @if($menu->icon)
                <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div>
                <span class="nav-link-icon"><i class="fa fa-{{ $menu->icon }}"></i></span>
                @endif
                <span class="nav-link-text">{{ $menu->menu }}</span>

            </div>
        </a>
        @endif
    </div>

    {{-- Jika punya anak, render lagi --}}
    @if(!empty($menu->children))
    <div class="parent-wrapper">
        <ul class="nav collapse parent" id="{{ $menu->menu_id }}">
            @foreach($menu->children as $child)
            @include('components.layouts.admin.menu_item', ['menu' => $child])
            @endforeach
        </ul>
    </div>
    @endif
</li>