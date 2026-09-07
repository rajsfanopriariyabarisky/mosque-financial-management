@extends('layouts.app_adminkit')

@section('title', 'Detail Buku Kas')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">
        <i class="fas fa-book-open text-primary me-2"></i>
        Detail Buku Kas - {{ $bukuKas->periode->translatedFormat('F Y') }}
    </h1>

    {{-- Informasi Buku Kas --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-light fw-bold">
            <i class="fas fa-info-circle me-1 text-secondary"></i>Informasi Buku Kas
        </div>
        <div class="card-body">
            <p><strong>Saldo Awal:</strong> <span class="text-muted">{{ number_format($bukuKas->saldo_awal) }}</span></p>
            <p><strong>Total Pemasukan:</strong> <span class="text-success fw-semibold">{{ number_format($bukuKas->total_pemasukan) }}</span></p>
            <p><strong>Total Pengeluaran:</strong> <span class="text-danger fw-semibold">{{ number_format($bukuKas->total_pengeluaran) }}</span></p>
            <p><strong>Saldo Akhir:</strong> <span class="text-dark fw-bold">{{ number_format($bukuKas->saldo_akhir) }}</span></p>
        </div>
    </div>

    {{-- Tabel Detail Transaksi --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light fw-bold">
            <i class="fas fa-list-alt me-1 text-secondary"></i>Detail Transaksi
        </div>
        <div class="card-body">
            @if(count($detailTransaksi) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                                <th class="text-end">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailTransaksi as $transaksi)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($transaksi['tanggal'])->format('d M Y') }}</td>
                                    <td>
                                        @if($transaksi['kategori'] == 'pemasukan')
                                            <span class="badge bg-success text-uppercase">{{ $transaksi['kategori'] }}</span>
                                        @else
                                            <span class="badge bg-danger text-uppercase">{{ $transaksi['kategori'] }}</span>
                                        @endif
                                    </td>
                                    <td>{{ ucfirst($transaksi['jenis']) }}</td>
                                    <td>{{ $transaksi['keterangan'] }}</td>
                                    <td class="text-end">{{ number_format($transaksi['jumlah']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    Belum ada transaksi pada periode ini.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
