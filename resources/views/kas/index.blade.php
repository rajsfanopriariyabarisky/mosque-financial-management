@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Kas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Kas</li>
    </ol>

    {{-- Alerts --}}
    @foreach (['success' => 'success', 'info' => 'info', 'error' => 'danger'] as $key => $type)
        @if(session($key))
            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                {{ session($key) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endforeach

    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow border-0 text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Pemasukan</h5>
                    <p class="card-text fs-5">{{ format_rupiah($totalpemasukan) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Total Pengeluaran</h5>
                    <p class="card-text fs-5">{{ format_rupiah($totalpengeluaran) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Saldo Akhir</h5>
                    <p class="card-text fs-5">{{ format_rupiah($saldo_akhir_total) }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Kas Table --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-cash-register me-2 text-primary"></i> Riwayat Kas</h5>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('buku-kas.index') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-book me-1"></i> Buku Kas
                </a>
                @if(auth()->user()->role == 'admin' && $disetujui)
                    <a href="{{ route('kas.view_pdf') }}" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-file-pdf me-1"></i> PDF
                    </a>
                @endif
            </div>
        </div>

        <div class="card-body">
            {{-- Ketua Approval Buttons --}}
            @if(auth()->user()->role == 'ketua')
            <div class="d-flex mb-3 gap-2">
                <form action="{{ route('kas.setujui') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check-circle me-1"></i> Setujui
                    </button>
                </form>
                <form action="{{ route('kas.tolak') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times-circle me-1"></i> Tolak
                    </button>
                </form>
            </div>
            @endif

            {{-- Pencarian --}}
            <form action="{{ route('kas.index') }}" method="GET" class="mb-3" style="max-width: 400px;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
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
                            <td>{{ $transaksi->unique_id }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d M Y') }}</td>
                            <td>{{ ucfirst($transaksi->kategori) }}</td>
                            <td>{{ ucfirst($transaksi->jenis) }}</td>
                            <td>{{ $transaksi->keterangan }}</td>
                            <td class="text-end">
                                @if($transaksi->kategori === 'pemasukan') <strong class="text-success">{{ format_rupiah($transaksi->jumlah) }}</strong> @else - @endif
                            </td>
                            <td class="text-end">
                                @if($transaksi->kategori === 'pengeluaran') <strong class="text-danger">{{ format_rupiah($transaksi->jumlah) }}</strong> @else - @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data kas tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $kas->appends(request()->except('page'))->links('pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection
