@extends('layouts.app_donatur')

@section('content')
<!-- Wrapper dengan posisi relatif -->
<div class="position-relative">
    <!-- Gambar Background -->
    <img src="{{ asset('images/masjidishlah.jpg') }}" alt="Background Donasi"
         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                object-fit: cover; z-index: -1; opacity: 0.2;">

    <!-- Kontainer Donasi -->
    <div class="container mt-5 mb-5 position-relative" style="z-index: 1;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Kartu Donasi -->
                <div class="card border-0 shadow-lg rounded-4" data-aos="fade-up">
                    <div class="card-body p-5">
                        <h1 class="mb-4 text-primary fw-bold">
                            <i class="fas fa-donate me-2"></i>Detail Donasi
                        </h1>

                        <!-- Informasi Donasi -->
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>ID Donasi:</strong> #{{ $donasi->id }}</li>
                            <li class="list-group-item"><strong>Tanggal:</strong> {{ $donasi->tanggal }}</li>
                            <li class="list-group-item"><strong>ID Pembayaran:</strong> {{ $donasi->order_id }}</li>
                            <li class="list-group-item"><strong>Nama Donatur:</strong> {{ $donasi->nama_donatur }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $donasi->email }}</li>
                            <li class="list-group-item"><strong>Jumlah:</strong> {{ format_rupiah($donasi->jumlah) }}</li>
                            <li class="list-group-item">
                                <strong>Status Pembayaran:</strong>
                                <span class="badge bg-{{ $donasi->status_pembayaran === 'paid' ? 'success' : ($donasi->status_pembayaran === 'menunggu' ? 'warning text-dark' : 'secondary') }}">
                                    {{ ucfirst($donasi->status_pembayaran) }}
                                </span>
                            </li>
                        </ul>

                        <!-- Aksi -->
                        @if($donasi->status_pembayaran === 'menunggu')
                            <form action="{{ route('donasi.store') }}" method="POST" id="payment-form">
                                @csrf
                                <input type="hidden" name="donasi_id" value="{{ $donasi->id }}">
                                <input type="hidden" name="nama_donatur" value="{{ $donasi->nama_donatur }}">
                                <input type="hidden" name="email" value="{{ $donasi->email }}">
                                <input type="hidden" name="jumlah" value="{{ $donasi->jumlah }}">
                                <button type="submit" class="btn btn-primary mt-3 w-100">
                                    <i class="fas fa-credit-card me-1"></i>Lanjutkan Pembayaran
                                </button>
                            </form>
                        @else
                            <a href="{{ route('donasi.download-pdf', $donasi->id) }}" class="btn btn-danger mt-3 w-100">
                                <i class="fas fa-file-pdf me-1"></i>Unduh Bukti Donasi (PDF)
                            </a>
                        @endif

                        <a href="{{ route('donasi.index') }}" class="btn btn-outline-secondary mt-3 w-100">
                            <i class="fas fa-arrow-left me-1"></i>Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AOS dan Style -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>

<style>
    .btn {
        transition: 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .list-group-item strong {
        min-width: 150px;
        display: inline-block;
    }
</style>
@endsection
