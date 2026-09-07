@extends('layouts.app_home')

@section('title', 'Data Kas')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s"
     style="background: url('{{ asset('images/masjidishlah.jpg') }}') center center no-repeat; background-size: cover;">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3">Data Kas</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{ route('dashboards.indexHome') }}">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Data Kas</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Ringkasan Kas Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h2 class="display-6 mb-3">Ringkasan Keuangan Masjid</h2>
            <p class="text-muted">Berikut ini adalah ringkasan pemasukan, pengeluaran, dan saldo akhir keuangan masjid hingga bulan ini.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-white rounded shadow-sm text-center p-4">
                    <div class="mb-2"><i class="fas fa-arrow-down fa-2x text-success"></i></div>
                    <h5>Total Pemasukan</h5>
                    <h4 class="text-success mt-2">{{ format_rupiah($totalpemasukan) }}</h4>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-white rounded shadow-sm text-center p-4">
                    <div class="mb-2"><i class="fas fa-arrow-up fa-2x text-danger"></i></div>
                    <h5>Total Pengeluaran</h5>
                    <h4 class="text-danger mt-2">{{ format_rupiah($totalpengeluaran) }}</h4>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="bg-white rounded shadow-sm text-center p-4">
                    <div class="mb-2"><i class="fas fa-wallet fa-2x text-primary"></i></div>
                    <h5>Saldo Akhir</h5>
                    <h4 class="text-primary mt-2">{{ format_rupiah($saldo_akhir_total) }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ringkasan Kas End -->

<!-- Daftar Transaksi Kas Start -->
<div class="container-xxl py-6 bg-light">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h2 class="display-6 mb-4">Laporan Keuangan Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.2s">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                                <th class="text-end">Pemasukan</th>
                                <th class="text-end">Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kas as $transaksi)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d M Y') }}</td>
                                <td>{{ ucfirst($transaksi->kategori) }}</td>
                                <td>{{ ucfirst($transaksi->jenis) }}</td>
                                <td>{{ $transaksi->keterangan }}</td>
                                <td class="text-end">
                                    @if ($transaksi->kategori == 'pemasukan')
                                        <span class="text-success">{{ format_rupiah($transaksi->jumlah) }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if ($transaksi->kategori == 'pengeluaran')
                                        <span class="text-danger">{{ format_rupiah($transaksi->jumlah) }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada transaksi yang tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $kas->links('pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Daftar Transaksi Kas End -->
@endsection
