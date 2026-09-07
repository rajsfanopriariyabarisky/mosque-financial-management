<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    {{-- Tampilan notifikasi --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .modal-content {
          border-radius: 15px;
        }
        .modal-header {
          border-top-left-radius: 15px;
          border-top-right-radius: 15px;
        }
        .btn-primary {
          background-color: #28a745;
          border-color: #28a745;
        }
        .btn-primary:hover {
          background-color: #218838;
          border-color:rgba(106, 34, 3, 0.41);
        }
        .modal-body {
          padding: 2rem;
        }
      </style>

</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="/" class="navbar-brand ms-4 ms-lg-0">
            <img src="{{ asset('images/icon-ishlah.png') }}" alt="Logo" class="img-fluid" style="max-height: 70px;">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto p-4 p-lg-0">
                <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="/datakeuangan" class="nav-item nav-link {{ request()->is('datakeuangan') ? 'active' : '' }}">Laporan</a>
                <a href="/sedekah" class="nav-item nav-link {{ request()->is('sedekah') ? 'active' : '' }}">Donasi</a>
                <a href="{{ url('/tentang-kami') }}" class="nav-item nav-link {{ request()->is('tentangkami') ? 'active' : '' }}">Tentang Kami</a>
                <a href="{{ url('/kontak') }}" class="nav-item nav-link {{ request()->is('kontak') ? 'disable' : '' }}">Kontak</a>
            </div>
            <div class=" d-none d-lg-flex">
                <div class="navbar-nav mx-auto p-4 p-lg-0">
                    @if (Route::has('login'))
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </a>

                        @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Register
                                </a>
                        @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer Start -->
    <footer class="container-fluid bg-dark text-light pt-5">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Logo & Deskripsi -->
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('images/icon-ishlah.png') }}" alt="Logo Masjid" style="max-height: 100px;" class="mb-3">
                    <p>Masjid Nurul Ishlah adalah tempat ibadah umat Muslim yang berlokasi di jantung kota. Kami berkomitmen untuk menjadi pusat dakwah, pendidikan, dan kegiatan sosial.</p>
                </div>

                <!-- Navigasi -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-4">Navigasi</h5>
                    <a class="btn btn-link text-white-50" href="/">Beranda</a>
                    <a class="btn btn-link text-white-50" href="/datakeuangan">Laporan Keuangan</a>
                    <a class="btn btn-link text-white-50" href="/sedekah">Donasi</a>
                    <a class="btn btn-link text-white-50" href="/tentang-kami">Tentang Kami</a>
                    <a class="btn btn-link text-white-50" href="/kontak">Kontak</a>
                </div>

                <!-- Kontak -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Kontak Kami</h5>
                    <p><i class="fa fa-map-marker-alt me-2"></i>Jl. Kramat Raya No.98, Jakarta Pusat, Indonesia (Universitas BSI)</p>
                    <p><i class="fa fa-phone-alt me-2"></i>+62 812-3456-7890</p>
                    <p><i class="fa fa-envelope me-2"></i>info@nurulishlah.or.id</p>
                </div>

                <!-- Donasi & Sosial -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Aksi Cepat</h5>
                    <a href="/sedekah" class="btn btn-success btn-sm rounded-pill mb-2"><i class="fas fa-donate me-2"></i>Donasi Sekarang</a>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.instagram.com/masjidnurulishlah/"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.instagram.com/masjidnurulishlah/"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle" href="https://www.instagram.com/masjidnurulishlah/"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="container-fluid text-center border-top border-secondary pt-3 pb-2">
            <small>&copy; {{ date('Y') }} Masjid Nurul Ishlah. All Rights Reserved.</small>
        </div>
    </footer>
    <!-- Footer End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @stack('scripts')

</body>
</html>
