@extends('layouts.app_donatur')

@section('content')
<div class="container mt-5 mb-5">
    <!-- Gambar di belakang -->
    <img src="{{ asset('images/masjidishlah.jpg') }}" alt="Background Donasi"
         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                object-fit: cover; z-index: -1; opacity: 0.2;">

    <!-- Konten di atas gambar -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Card utama -->
            <div class="card border-0 shadow-lg rounded-4" data-aos="fade-up">
                <div class="card-body p-5">
                    <h1 class="mb-4 text-primary fw-bold">
                        <i class="fas fa-receipt me-2"></i>Riwayat Pembayaran
                    </h1>

                    <!-- Tabel Riwayat -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>ID Pembayaran</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayatUsers as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>{{ $item->nama_donatur }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ format_rupiah($item->jumlah) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $item->status_pembayaran === 'paid' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($item->status_pembayaran) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('donasi.show', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-muted">Belum ada riwayat donasi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $riwayatUsers->links('pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahan AOS dan Style -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>

<style>
    .table th, .table td {
        vertical-align: middle;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-secondary {
        background-color: #6c757d;
    }

    .btn-outline-primary {
        transition: 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: #fff;
    }
</style>
@endsection
