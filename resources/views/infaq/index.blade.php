@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Infaq</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Infaq</li>
    </ol>

    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-success text-white rounded-top d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-hand-holding-usd me-2"></i> Tabel Data Infaq
            </div>
            @if(auth()->user()->role == 'admin')
            <a href="{{ route('infaq.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Infaq
            </a>
            @endif
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 15%;">Tanggal</th>
                            <th style="width: 30%;">Keterangan</th>
                            <th style="width: 20%;">Jumlah</th>
                            <th style="width: 25%;">Komentar</th>
                            @if(auth()->user()->role == 'ketua')
                            <th style="width: 10%;">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($infaq as $data)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>{{ format_rupiah($data->jumlah) }}</td>
                            <td>{{ $data->komentar ?? '-' }}</td>
                            @if(auth()->user()->role == 'ketua' && \Carbon\Carbon::parse($data->tanggal)->isCurrentMonth())
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('infaq.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('infaq.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data infaq.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
