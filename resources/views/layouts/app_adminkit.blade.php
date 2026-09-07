<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Admin panel for MasjidIshlah financial management system" />
    <meta name="author" content="MasjidIshlah" />
    <link rel="shortcut icon" href="{{ asset('adminkit/img/icon-ishlah.png') }}" />
    <title>@yield('title', 'Dashboard') | MasjidIshlah</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .sb-sidenav-dark .sb-sidenav-menu .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .navbar-brand {
            font-size: 1.1rem;
        }
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href=""><i class="fas fa-mosque me-2"></i>Pengurus</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <div class="ms-auto me-0 me-md-3 my-2 my-md-0">
            @auth
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user-circle fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit.admin') }}"><i class="fas fa-user-edit me-2"></i>Profil</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            @endauth
        </div>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Data Laporan Masjid</div>
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'ketua')
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link {{ request()->routeIs('kas.index') ? 'active' : '' }}" href="{{ route('kas.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-wallet"></i></div>
                            Data Keuangan
                        </a>
                        <a class="nav-link {{ request()->routeIs('rabs.index') ? 'active' : '' }}" href="{{ route('rabs.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                            Rancangan Anggaran
                        </a>
                        @endif
                        @if(auth()->user()->role == 'admin')
                        <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Data Donatur
                        </a>
                        <a class="nav-link {{ request()->routeIs('donasi.riwayat_donasi') ? 'active' : '' }}" href="{{ route('donasi.riwayat_donasi') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                            Riwayat Donasi
                        </a>
                        <a class="nav-link collapsed {{ request()->is('news*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseNews" aria-expanded="false" aria-controls="collapseNews">
                            <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                            News
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->is('news*') ? 'show' : '' }}" id="collapseNews" aria-labelledby="headingNews" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.kuliner.index') ? 'active' : '' }}" href="{{ route('admin.kuliner.index') }}"><i class="fas fa-cogs me-2"></i>Manage</a>
                            </nav>
                        </div>

                        @endif
                        <div class="sb-sidenav-menu-heading">Laporan Keuangan</div>
                        <a class="nav-link collapsed {{ request()->is('infaq*', 'zakat*', 'qurban*', 'parkir*', 'kontribusi*', 'insidental*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePemasukan" aria-expanded="false" aria-controls="collapsePemasukan">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                            Pemasukan
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->is('infaq*', 'zakat*', 'qurban*', 'parkir*', 'kontribusi*', 'insidental*') ? 'show' : '' }}" id="collapsePemasukan" aria-labelledby="headingPemasukan" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('infaq.index') ? 'active' : '' }}" href="{{ route('infaq.index') }}"><i class="fas fa-hand-holding-heart me-2"></i>Infaq</a>
                                {{--<a class="nav-link {{ request()->routeIs('zakat.index') ? 'active' : '' }}" href="{{ route('zakat.index') }}"><i class="fas fa-gift me-2"></i>Zakat</a>
                                <a class="nav-link {{ request()->routeIs('qurban.index') ? 'active' : '' }}" href="{{ route('qurban.index') }}"><i class="fas fa-drumstick-bite me-2"></i>Qurban</a>
                                <a class="nav-link {{ request()->routeIs('parkir.index') ? 'active' : '' }}" href="{{ route('parkir.index') }}"><i class="fas fa-parking me-2"></i>Parkir</a>
                                <a class="nav-link {{ request()->routeIs('kontribusi.index') ? 'active' : '' }}" href="{{ route('kontribusi.index') }}"><i class="fas fa-hands-helping me-2"></i>Kontribusi</a>
                                <a class="nav-link {{ request()->routeIs('insidental.index') ? 'active' : '' }}" href="{{ route('insidental.index') }}"><i class="fas fa-random me-2"></i>Insidental</a>--}}
                            </nav>
                        </div>
                        <a class="nav-link collapsed {{ request()->is('operasional*', 'pengajian*', 'lainnya*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePengeluaran" aria-expanded="false" aria-controls="collapsePengeluaran">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                            Pengeluaran
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->is('operasional*', 'pengajian*', 'lainnya*') ? 'show' : '' }}" id="collapsePengeluaran" aria-labelledby="headingPengeluaran" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('operasional.index') ? 'active' : '' }}" href="{{ route('operasional.index') }}"><i class="fas fa-tools me-2"></i>Beban Operasional</a>
                                <a class="nav-link {{ request()->routeIs('pengajian.index') ? 'active' : '' }}" href="{{ route('pengajian.index') }}"><i class="fas fa-book-reader me-2"></i>Pengajian</a>
                                <a class="nav-link {{ request()->routeIs('lainnya.index') ? 'active' : '' }}" href="{{ route('lainnya.index') }}"><i class="fas fa-ellipsis-h me-2"></i>Lainnya</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ Auth::user()->name ?? 'Guest' }}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('sm/summernote-bs4.css') }}" rel="stylesheet">
    <script src="{{ asset('sm/summernote-bs4.js') }}"></script>
    <script>
        $(document).ready(function (){
            $('#summernote').summernote({
                tabsize: 2,
                height: 100
            });

            $('.rupiah').mask("#.##0", {
                reverse: true
            });
        });
    </script>
</body>
</html>
