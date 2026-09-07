@extends('layouts.app_adminkit')

@section('title', 'Rancangan Anggaran Biaya')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-coins me-2 text-primary"></i>Data Rancangan Anggaran Biaya</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Rancangan Anggaran Biaya</li>
    </ol>

    {{-- Flash Messages --}}
    @foreach (['success' => 'success', 'info' => 'info', 'error' => 'danger'] as $msg => $class)
        @if(session($msg))
            <div class="alert alert-{{ $class }} shadow-sm alert-dismissible fade show" role="alert">
                {{ session($msg) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endforeach

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-2 text-primary"></i><strong>Rancangan Anggaran Biaya</strong>
            </div>
            @if(auth()->user()->role != 'ketua')
                <div>
                    <a href="{{ route('rabs.create') }}" class="btn btn-sm btn-primary me-2"><i class="fas fa-plus me-1"></i>Tambah Data</a>
                    @if(auth()->user()->role == 'admin' && $disetujui)
                        <a href="{{ route('rabs.view_pdf') }}" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf me-1"></i>Ekspor PDF</a>
                    @endif
                </div>
            @endif
        </div>

        <div class="card-body">
            @if(auth()->user()->role == 'ketua')
                <div class="mb-3">
                    <form action="{{ route('rabs.setujui') }}" method="POST" class="d-inline-block me-2">
                        @csrf
                        <button type="submit" class="btn btn-success"><i class="fas fa-check me-1"></i>Setujui</button>
                    </form>
                    <form action="{{ route('rabs.tolak') }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fas fa-times me-1"></i>Tolak</button>
                    </form>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Program</th>
                            <th>Periode</th>
                            <th>Kategori</th>
                            <th>Jenis</th>
                            <th>Keterangan</th>
                            <th class="text-center">Jumlah</th>
                            @if(auth()->user()->role != 'ketua')
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rabs as $rab)
                            <tr>
                                <td>{{ $rab->nama }}</td>
                                <td>{{ $rab->periode }}</td>
                                <td>
                                    <span class="badge bg-{{ $rab->kategori === 'pemasukan' ? 'success' : 'danger' }}">
                                        {{ ucfirst($rab->kategori) }}
                                    </span>
                                </td>
                                <td>{{ ucfirst($rab->jenis) }}</td>
                                <td>{!! $rab->keterangan !!}</td>
                                <td class="text-center fw-semibold text-primary">{{ format_rupiah($rab->jumlah) }}</td>
                                @if(auth()->user()->role != 'ketua')
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('rabs.edit', $rab->id) }}" class="btn btn-sm btn-warning me-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('rabs.destroy', $rab->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada data RAB</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
