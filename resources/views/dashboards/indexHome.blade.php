@extends('layouts.app_home')

@section('title', 'Donasi')

@section('content')
<!-- Header -->
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s"
     style="background: url('{{ asset('images/masjidishlah.jpg') }}') center center / cover no-repeat;">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3">Donasi</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Donasi</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Donasi Sekarang -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h2 class="display-6 mb-3">Infaq Sekarang</h2>
            <p class="text-muted">Dukung kegiatan Masjid Nurul Ishlah untuk terus memberikan manfaat kepada umat.</p>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($indexHome as $dashboard)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="card h-100 shadow border-0 rounded-4">
                    <div class="position-relative">
                        <img src="{{ asset('images/' . $dashboard->image) }}" alt="{{ $dashboard->title }}"
                             class="card-img-top img-fluid rounded-top" style="height: 230px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <a class="btn btn-light rounded-circle shadow-sm" href="#">
                                <i class="fa fa-hand-holding-heart text-primary"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4 text-center d-flex flex-column">
                        <h5 class="card-title mb-3 text-primary">{{ $dashboard->title }}</h5>
                        <p class="card-text text-muted mb-4">{{ Str::limit($dashboard->content, 100) }}</p>
                        {{--a href="https://www.example.com/payment/dummy" class="btn btn-primary mt-auto">--}}
                            Infaq Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">Belum ada data donasi yang tersedia saat ini.</div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Ajakan Donatur -->
<div class="container-xxl py-6 bg-light">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h2 class="display-6 mb-3">Jadilah Bagian dari Kebaikan</h2>
            <p class="text-muted">Gabung sebagai donatur tetap Masjid Nurul Ishlah dan dapatkan pahala yang terus mengalir.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ route('register') }}" class="btn btn-success btn-lg me-3 px-5">
                    <i class="fas fa-user-plus me-2"></i>Daftar
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-5">Masuk</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Donasi -->
<div class="modal fade" id="modalDonasi" tabindex="-1" aria-labelledby="labelModalDonasi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title" id="labelModalDonasi">
                    <i class="fas fa-hand-holding-heart me-2"></i>Jadilah Bagian dari Kebaikan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center p-4">
                <img src="{{ asset('images/donatur.png') }}" alt="Ilustrasi Donasi"
                     class="img-fluid mb-3" style="max-height: 200px;">
                <h4 class="mb-3">Bersama, Kita Bisa Membuat Perbedaan</h4>
                <p class="mb-4">Setiap donasi Anda, sekecil apapun, dapat memberikan harapan dan mengubah kehidupan seseorang.</p>
                <div class="d-grid gap-2">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sebagai Donatur
                    </a>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Nanti Saja</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalDonasi = new bootstrap.Modal(document.getElementById('modalDonasi'), {
            keyboard: false
        });
        setTimeout(function () {
            modalDonasi.show();
        }, 1000); // 1 detik setelah load
    });
</script>
@endpush

@endsection
