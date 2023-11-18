<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a class="mx-5 fw-bolder" href="/dashboard">EduPay</a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                @if (Auth::guard('petugas')->check())
                    <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="/dashboard" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if (Auth::guard('petugas')->user()->level == 'admin')

                        <li class="sidebar-item {{ Request::is('dashboard/petugas*') ? 'active' : '' }}">
                            <a href="/dashboard/petugas" class='sidebar-link'>
                                <i class="bi bi-person-bounding-box"></i>
                                <span>Data petugas</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::is('dashboard/siswa*') ? 'active' : '' }} has-sub">
                            <a href="/dashboard/siswa/kelas" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Data siswa & kelas</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="/dashboard/siswa">Siswa</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/dashboard/siswa/kelas">Kelas</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ Request::is('dashboard/spp*') ? 'active' : '' }}">
                            <a href="/dashboard/spp" class='sidebar-link'>
                                <i class="bi bi-wallet"></i>
                                <span>Data spp</span>
                            </a>
                        </li>  
                    @endif
                    <li class="sidebar-item {{ Request::is('dashboard/tagihan*') ? 'active' : '' }}">
                        <a href="/dashboard/tagihan" class='sidebar-link'>
                            <i class="bi bi-card-checklist"></i>
                            <span>Data tagihan</span>
                        </a>
                    </li>  
                    <li class="sidebar-item {{ Request::is('dashboard/pembayaran*') ? 'active' : '' }}">
                        <a href="/dashboard/pembayaran" class='sidebar-link'>
                            <i class="bi bi-cash-stack"></i>
                            <span>Data Pembayaran</span>
                        </a>
                    </li>
                @else 
                    <li class="sidebar-item {{ Request::is('dashboard/pembayaranmu*') ? 'active' : '' }}">
                        <a href="/dashboard/pembayaranmu" class='sidebar-link'>
                            <i class="bi bi-cash-stack"></i>
                            <span>Pembayaran anda</span>
                        </a>
                    </li> 
                    <li class="sidebar-item {{ Request::is('dashboard/tagihanmu*') ? 'active' : '' }}">
                        <a href="/dashboard/tagihanmu" class='sidebar-link'>
                            <i class="bi bi-card-checklist"></i>
                            <span>Tagihan anda</span>
                        </a>
                    </li>   
                @endif

                <li class="sidebar-item active"  style="margin-top: 50px">
                    <a href="/dashboard/profile" class='sidebar-link'>
                        <i class="bi bi-person-badge"></i>
                        <span>Profile</span>
                    </a>
                </li>  

                <li class="sidebar-item">
                    <form action="/auth/logout" method="POST">
                        @csrf
                        <button class="w-100 btn btn-primary text-white" type="submit">
                            <span class="d-flex align-items-center justify-content-between">
                                <span class="d-flex align-items-center">
                                    <div class="row">
                                        <div class="col mt-1">
                                            <i class="bi bi-box-arrow-right"></i>
                                        </div>
                                        <div class="col">
                                            <span class="">Logout</span>
                                        </div>
                                    </div>
                                </span>
                            </span>
                        </button>
                    </form>
                </li>                
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>