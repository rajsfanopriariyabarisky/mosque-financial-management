@extends('layouts.app_adminkit')

@section('title', 'Buku Kas')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-book me-2 text-primary"></i>Buku Kas</h1>

    {{-- Tombol Simpan --}}
    <div class="mb-4">
        <a href="{{ route('buku-kas.simpan') }}" onclick="event.preventDefault(); document.getElementById('simpan-form').submit();" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-save me-1"></i> Simpan Buku Kas Bulan Lalu
        </a>
        <form id="simpan-form" action="{{ route('buku-kas.simpan') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Buku Kas Cards --}}
    <div class="row">
        @forelse($bukuKas as $bk)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold">
                            <i class="fas fa-calendar-alt me-2"></i>{{ $bk->periode->translatedFormat('F Y') }}
                        </h5>
                        <hr>
                        <p class="mb-1"><strong>Saldo Awal:</strong> <span class="text-muted">{{ number_format($bk->saldo_awal) }}</span></p>
                        <p class="mb-1 text-success"><strong>Pemasukan:</strong> {{ number_format($bk->total_pemasukan) }}</p>
                        <p class="mb-1 text-danger"><strong>Pengeluaran:</strong> {{ number_format($bk->total_pengeluaran) }}</p>
                        <p class="mb-3"><strong>Saldo Akhir:</strong> <span class="fw-bold text-dark">{{ number_format($bk->saldo_akhir) }}</span></p>
                        <a href="{{ route('buku-kas.show', $bk->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p><i class="fas fa-info-circle me-1"></i>Belum ada data buku kas.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $bukuKas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
