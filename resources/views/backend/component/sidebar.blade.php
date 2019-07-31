<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-left justify-content-left" href="#">
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
    @if (Auth::user()->role->slug == 'super-admin')
    {{-- mata uang --}}
    <li class="nav-item {{active('currency.index')}}">
        <a class="nav-link" href="{{route('currency.index')}}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Mata uang</span>
        </a>
    </li>        
    @endif

    {{-- unit --}}
    <li class="nav-item {{active('unit.index')}}">
        <a class="nav-link" href="{{route('unit.index')}}">
            <i class="fas fa-fw fa-box"></i>
            <span>Unit</span>
        </a>
    </li>
    {{-- nilai tukar --}}
    <li class="nav-item {{active('exchangeRate.index')}}">
        <a class="nav-link" href="{{route('exchangeRate.index')}}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Rates</span>
        </a>
    </li>
    {{-- customer --}}
    <li class="nav-item {{active('customer.index')}}">
        <a class="nav-link" href="{{route('customer.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Customer</span>
        </a>
    </li>
    {{-- transaksi --}}
    <li class="nav-item {{active('transaction.index')}}">
        <a class="nav-link" href="{{route('transaction.index')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Transaction</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{is_active('invoice.index') ? '':'collapsed'}}" href="#" data-toggle="collapse" data-target="#invoice" aria-expanded="true" aria-controls="invoice">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Invoice</span>
        </a>
        <div id="invoice" class="collapse {{is_active('invoice.*')  ? 'show':''}}" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{active('invoice.where')}}" href="{{route('invoice.where','all')}}">Semua Invoice</a>
            <a class="collapse-item {{active('invoice.where')}}" href="{{route('invoice.where','paid')}}">Invoice Terbayar</a>
            <a class="collapse-item {{active('invoice.where')}}" href="{{route('invoice.where','unpaid')}}">Invoice Belum Terbayar</a>            
            
            </div>
        </div>
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
