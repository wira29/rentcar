<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index-2.html">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20"
                xml:space="preserve">
                <path
                    d="M19.4,4.1l-9-4C10.1,0,9.9,0,9.6,0.1l-9,4C0.2,4.2,0,4.6,0,5s0.2,0.8,0.6,0.9l9,4C9.7,10,9.9,10,10,10s0.3,0,0.4-0.1l9-4
      C19.8,5.8,20,5.4,20,5S19.8,4.2,19.4,4.1z" />
                <path
                    d="M10,15c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
      c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,15,10.1,15,10,15z" />
                <path
                    d="M10,20c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
      c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,20,10.1,20,10,20z" />
            </svg>

            <span class="align-middle me-3">{{ config('app.name') }}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Master</li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>
            @if(auth()->user()->roles->pluck('name')[0] == 'admin')
            <li class="sidebar-item {{ request()->routeIs('admin.rentcars.*') ? 'active' : '' }}">
                <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-car"></i>
                    <span class="align-middle">Rental Mobil</span>
                </a>
                <ul id="pages"
                    class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('admin.rentcars.*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.rentcars.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.rentcars.create') }}">Tambah Rental</a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.rentcars.index') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.rentcars.index') }}">List Rental</a>
                    </li>
                </ul>
            </li>
{{--            <li class="sidebar-item {{ request()->routeIs('attendance.today') ? 'active' : '' }}">--}}
{{--                <a class="sidebar-link" href="">--}}
{{--                    <i class="align-middle me-2 fas fa-fw fa-chalkboard-teacher"></i>--}}
{{--                    <span class="align-middle">Absensi Siswa</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            @elseif(auth()->user()->roles->pluck('name')[0] == 'rental')
                <li class="sidebar-item {{ request()->routeIs('rental.cars.*') ? 'active' : '' }}">
                    <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle me-2 fas fa-fw fa-car"></i>
                        <span class="align-middle">Mobil</span>
                    </a>
                    <ul id="pages"
                        class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('rental.cars.*') ? 'show' : '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ request()->routeIs('rental.cars.create') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('rental.cars.create') }}">Tambah Mobil</a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('rental.cars.index') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('rental.cars.index') }}">List Mobil</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ request()->routeIs('rental.drivers.*') ? 'active' : '' }}">
                    <a data-bs-target="#pages-drivers" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle me-2 fas fa-fw fa-users"></i>
                        <span class="align-middle">Sopir</span>
                    </a>
                    <ul id="pages-drivers"
                        class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('rental.drivers.*') ? 'show' : '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ request()->routeIs('rental.drivers.create') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('rental.drivers.create') }}">Tambah Sopir</a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('rental.drivers.index') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('rental.drivers.index') }}">List Sopir</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ request()->routeIs('rental.conditions.*') ? 'active' : '' }}">
                    <a data-bs-target="#pages-conditions" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle me-2 fas fa-fw fa-users"></i>
                        <span class="align-middle">Ketentuan</span>
                    </a>
                    <ul id="pages-conditions"
                        class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('rental.conditions.*') ? 'show' : '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ request()->routeIs('rental.conditions.create') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('rental.conditions.create') }}">Tambah Ketentuan</a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('rental.conditions.index') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('rental.conditions.index') }}">List Ketentuan</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('rental.rental.edit', auth()->user()->rental->id) }}">
                        <i class="align-middle" data-feather="sliders"></i>
                        <span class="align-middle">Rental</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
