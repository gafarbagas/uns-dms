<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion rounded-right" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('overview')}}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-file"></i>
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ Route::is('overview') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('overview')}}">
            <i class="fas fa-fw fa-chart-pie"></i>
            <span>Overview</span>
        </a>
    </li>

    <li class="nav-item {{ Route::is('pengajuan*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('pengajuan')}}">
            <i class="fas fa-fw fa-file"></i>
            <span>Pengajuan</span>
        </a>
    </li>

    @if (Auth::check() && Auth::user()->role == 'admin')
        <li class="nav-item {{ Route::is('student*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('student')}}">
                <i class="fas fa-fw fa-users"></i>
                <span>Mahasiswa</span>
            </a>
        </li>
    @endif

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>