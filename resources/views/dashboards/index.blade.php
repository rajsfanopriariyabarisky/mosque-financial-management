@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-primary fw-bold">
        <i class="fas fa-home me-2"></i>Selamat Datang, {{ Auth::user()->name }}
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Beranda Admin Masjid Nurul Ishlah</li>
    </ol>

    @if(Auth::user()->role == 'admin')
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">
                <i class="fas fa-qrcode me-2"></i>Tabel Data Gambar QRIS & Laporan
            </h5>
            @if($dashboards->isEmpty())
            <a href="{{ route('dashboard.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i>Tambah Data
            </a>
            @endif
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Konten</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dashboards as $dashboard)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $dashboard->title }}</td>
                            <td class="text-start">{{ Str::limit($dashboard->content, 100) }}</td>
                            <td>
                                @if($dashboard->image)
                                    <img src="{{ asset('images/' . $dashboard->image) }}" alt="Image" class="img-thumbnail shadow-sm" style="max-width: 100px;">
                                @else
                                    <span class="text-muted fst-italic">Tidak Ada Gambar</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('dashboard.edit', $dashboard->id) }}" class="btn btn-warning btn-sm mb-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dashboard.destroy', $dashboard->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Belum ada data laporan atau gambar QRIS yang ditambahkan.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Optional Style --}}
<style>
    table th, table td {
        vertical-align: middle !important;
    }

    .btn-sm i {
        margin-right: 2px;
    }
</style>
@endsection
