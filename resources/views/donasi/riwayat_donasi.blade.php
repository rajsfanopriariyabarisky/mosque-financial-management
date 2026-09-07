@extends('layouts.app_adminkit')

@section('title', 'Riwayat Pembayaran Donasi')

@section('content')
<div class="container-fluid px-4">
    <!-- Judul & Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h1 class="text-primary fw-bold" data-aos="fade-right">
                <i class="fas fa-history me-2"></i> Riwayat Pembayaran Donasi
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Riwayat Pembayaran</li>
            </ol>
        </div>
    </div>

    <!-- Ringkasan Donasi -->
    <div class="row mb-4">
        <div class="col-md-4" data-aos="zoom-in">
            <div class="card shadow-sm border-0 bg-light rounded-4">
                <div class="card-body">
                    <h5 class="text-muted">Total Semua Donasi</h5>
                    <h3 class="text-success fw-bold">{{ format_rupiah($totalSemuaDonasi) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="card shadow-sm border-0 bg-light rounded-4">
                <div class="card-body">
                    <h5 class="text-muted">Total Bulan Ini</h5>
                    <h3 class="text-primary fw-bold">{{ format_rupiah($totalBulanIni) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="card shadow-sm border-0 bg-light rounded-4">
                <div class="card-body">
                    <h5 class="text-muted">Total Bulan Lalu</h5>
                    <h3 class="text-warning fw-bold">{{ format_rupiah($totalBulanLalu) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Total Donasi Per Bulan -->
    <div class="card mb-4 shadow-sm border-0" data-aos="fade-up">
        <div class="card-body">
            <h5 class="card-title mb-3 text-primary">Total Donasi per Bulan ({{ now()->year }})</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Bulan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totalPerBulan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F') }}</td>
                            <td>{{ format_rupiah($item->total) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Daftar Transaksi -->
    <div class="card shadow-sm border-0" data-aos="fade-up" data-aos-delay="100">
        <div class="card-body">
            <h5 class="card-title mb-3 text-primary">Daftar Transaksi</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>ID Pembayaran</th>
                            <th>Nama Donatur</th>
                            <th>Email</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatPembayaran as $donasi)
                        <tr>
                            <td>{{ $donasi->tanggal }}</td>
                            <td>{{ $donasi->order_id }}</td>
                            <td>{{ $donasi->nama_donatur }}</td>
                            <td>{{ $donasi->email }}</td>
                            <td>{{ format_rupiah($donasi->jumlah) }}</td>
                            <td>
                                <span class="badge bg-{{ $donasi->status_pembayaran === 'paid' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($donasi->status_pembayaran) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $riwayatPembayaran->links('pagination') }}
            </div>
        </div>
    </div>
</div>

<!-- AOS for Animations -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>

<!-- Custom Styling -->
<style>
    .card-title {
        font-weight: bold;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-secondary {
        background-color: #6c757d;
    }

    .table td, .table th {
        vertical-align: middle;
    }
</style>
@endsection
