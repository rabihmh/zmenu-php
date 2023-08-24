<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    @foreach($items as $item)
        @if(!isset($item['submenu']))

            <li class="nav-item">
                <a class="nav-link" href="{{$item['route']}}">
                    <i class="{{$item['icon']}}"></i>
                    <span>{{$item['label']}}</span></a>
            </li>

        @else
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                   data-target="#submenu-{{ $loop->iteration }}"
                   aria-expanded="true" aria-controls="submenu-{{ $loop->iteration }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
                <div id="submenu-{{ $loop->iteration }}" class="collapse"
                     aria-labelledby="heading{{ $loop->iteration }}"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @foreach($item['submenu'] as $menu)
                            <a class="collapse-item" href="{{ $menu['url'] }}">{{ $menu['label'] }}</a>
                        @endforeach
                    </div>
                </div>
            </li>
        @endif
        <!-- Divider -->
        <hr class="sidebar-divider">
    @endforeach

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
