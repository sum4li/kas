<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-left justify-content-left" href="#">
        <div class="sidebar-brand-icon">
                {{App\Setting::where('slug','nama-toko')->get()->first()->description}}
        </div>
        <div class="sidebar-brand-text">{{App\Setting::where('slug','nama-toko')->get()->first()->description}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menu
    </div>
    {{-- dashboard --}}
    <li class="nav-item {{active('dashboard')}}">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    

    {{-- transaksi --}}
    <li class="nav-item {{active('transaction.index','income')}}">
        <a class="nav-link" href="{{route('transaction.index','income')}}">
            <i class="fas fa-fw fa-download"></i>
            <span>Pendapatan</span>
        </a>
    </li>      
    <li class="nav-item {{active('transaction.index','expense')}}">
        <a class="nav-link" href="{{route('transaction.index','expense')}}">
            <i class="fas fa-fw fa-upload"></i>
            <span>Pengeluaran</span>
        </a>
    </li>      
    @if (Auth::user()->role->slug == 'super-admin')
    <li class="nav-item {{active('setting.index')}}">
        <a class="nav-link" href="{{route('setting.index')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Setting</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{is_active('user.index') || is_active('role.index') ? '':'collapsed'}}" href="#" data-toggle="collapse" data-target="#user" aria-expanded="true" aria-controls="user">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span>
        </a>
        <div id="user" class="collapse {{is_active('user.index') || is_active('role.index')  ? 'show':''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{active('user.index')}}" href="{{route('user.index')}}">Pengguna</a>
            <a class="collapse-item {{active('role.index')}}" href="{{route('role.index')}}">Hak Akses</a>
            </div>
        </div>
    </li>                
    @endif
</ul>
<!-- End of Sidebar -->
