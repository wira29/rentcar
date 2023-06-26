<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="d-none d-sm-inline-block mt-3">
        <h4>Login Sebagai: <span
                class="badge badge-soft-success">{{ auth()->user()->roles->pluck('name')[0] }}</span></h4>
    </div>

    <ul class="navbar-nav"></ul>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    @if (auth()->user()->photo)
                        <img src="{{ asset(auth()->user()->photo) }}"
                            class="avatar img-fluid rounded-circle me-1" alt="{{ auth()->user()->name }}" />
                    @else
                        <img src="{{ asset('admin-assets/img/avatars/avatar.jpg') }}"
                            class="avatar img-fluid rounded-circle me-1" alt="{{ auth()->user()->name }}" />
                    @endif

                    <span class="text-dark">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('edit-profile', [ 'id' => auth()->user()->id]) }}" class="nav-link"><i class="align-middle me-1"
                            data-feather="user"></i>
                            Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Sign
                        out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
