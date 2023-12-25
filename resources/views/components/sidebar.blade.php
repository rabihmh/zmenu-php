<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('tenant.admin.home')}}">
        <div class="sidebar-brand-text mx-3">{{\App\Managers\TenantDataManger::getTenantRestaurant()->name?? ""}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @foreach($items as $item)
        @php
            $isActiveItem = isset($item['route']) && \Illuminate\Support\Facades\Request::route()->getName() === $item['route'];
            $isActiveSubmenu = false;

            if (isset($item['submenu'])) {
                foreach ($item['submenu'] as $menu) {
                    if (\Illuminate\Support\Facades\Request::route()->getName() === $menu['url']) {
                        $isActiveSubmenu = true;
                        break;
                    }
                }
            }
        @endphp

        <li class="nav-item {{ $isActiveItem || $isActiveSubmenu ? 'active' : '' }}">
            @if(!isset($item['submenu']) && isset($item['route']))
                <a class="nav-link" href="{{ route($item['route']) }}">
                    <i class="{{ $item['icon'] }}"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            @elseif(isset($item['submenu']))
                <a class="nav-link collapsed {{ $isActiveItem || $isActiveSubmenu ? 'show' : '' }}"
                   href="#" data-toggle="collapse"
                   data-target="#submenu-{{ $loop->iteration }}"
                   aria-expanded="{{ $isActiveItem || $isActiveSubmenu ? 'true' : 'false' }}"
                   aria-controls="submenu-{{ $loop->iteration }}">
                    <i class="{{$item['icon']}}"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
                <div id="submenu-{{ $loop->iteration }}"
                     class="collapse {{ $isActiveItem || $isActiveSubmenu ? 'show' : '' }}"
                     aria-labelledby="heading{{ $loop->iteration }}"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @foreach($item['submenu'] as $menu)
                            <a class="collapse-item {{ \Illuminate\Support\Facades\Request::route()->getName() === $menu['url'] ? 'active' : '' }}"
                               href="{{ route($menu['url']) }}">{{ $menu['label'] }}</a>
                        @endforeach
                    </div>
                </div>
            @endif
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
    @endforeach

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
