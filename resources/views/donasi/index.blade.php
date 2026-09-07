@extends('layouts.app_donatur')

@section('title', 'Daftar Donasi')

@section('content')
<div class="position-relative">
    <!-- Gambar Background -->
    <img src="{{ asset('images/masjidishlah.jpg') }}" alt="Background Donasi"
         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                object-fit: cover; z-index: -1; opacity: 0.2;">

    <!-- Konten -->
    <div class="container py-5 position-relative" style="z-index: 1;">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-5 text-center"> <!-- Tambahkan class text-center di sini -->
                        <h1 class="mb-4 text-primary fw-bold">
                            <i class="fas fa-hand-holding-heart me-2 text-success"></i> Mari Ber-Amal Yuk!!
                        </h1>

                        <!-- Tombol Buat Donasi -->
                        <a href="{{ route('donasi.create') }}" class="btn btn-success btn-lg shadow-sm mb-4">
                            <i class="bi bi-plus-circle me-2"></i> Amal Disini
                        </a>

                        <hr class="my-5" style="border-top: 3px dashed #000000;">

                        <!-- Kartu-Kartu Donasi -->
                        @forelse($donasi as $item)
                            <div class="card border-0 shadow-sm rounded-3 mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-2">
                                                <i class="fas fa-receipt text-success me-2"></i>
                                                Donasi #{{ $item->id }}
                                            </h5>
                                            <p class="mb-1"><strong>Tanggal:</strong> {{ $item->tanggal }}</p>
                                            <p class="mb-1"><strong>Jumlah:</strong> {{ format_rupiah($item->jumlah) }}</p>
                                            <p class="mb-1"><strong>Status:</strong>
                                                <span class="badge bg-{{ $item->status_pembayaran === 'paid' ? 'success' : ($item->status_pembayaran === 'menunggu' ? 'warning text-dark' : 'secondary') }}">
                                                    {{ ucfirst($item->status_pembayaran) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            @if($item->status_pembayaran === 'menunggu')
                                                <form action="{{ route('donasi.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="donasi_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="nama_donatur" value="{{ $item->nama_donatur }}">
                                                    <input type="hidden" name="email" value="{{ $item->email }}">
                                                    <input type="hidden" name="jumlah" value="{{ $item->jumlah }}">
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-credit-card me-1"></i>Bayar Sekarang
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('donasi.riwayat_users', $item->id) }}" class="btn btn-outline-primary btn-sm mb-1">
                                                    <i class="fas fa-clock me-1"></i>Lihat Riwayat
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-5" style="border-top: 2px dashed #000000;">
                        @empty
                            <div class="alert alert-info">Belum ada donasi yang tercatat. Yuk mulai berdonasi sekarang!</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000, once: true });
</script>

<!-- Custom Styling -->
<style>
    .btn-success {
        background-color: #28a745;
        border: none;
        transition: all 0.2s ease-in-out;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: scale(1.03);
    }

    .card h5 {
        font-size: 1.25rem;
    }

    .badge {
        font-size: 0.9rem;
    }
</style>
@endsection
