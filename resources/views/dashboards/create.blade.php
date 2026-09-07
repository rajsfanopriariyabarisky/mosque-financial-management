@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-primary fw-bold">
        <i class="fas fa-plus-circle me-2"></i>Buat Laporan Keuangan Baru
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Tambah Data</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-light fw-semibold">
                    <i class="fas fa-file-alt me-2"></i>Formulir Laporan Keuangan
                </div>
                <div class="card-body py-4 px-5">

                    {{-- Validasi Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5><i class="fas fa-exclamation-circle me-2"></i>Terjadi Kesalahan:</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Laporan Keuangan Ramadhan 1446H" required>
                        </div>

                        {{-- Konten --}}
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">Konten</label>
                            <textarea class="form-control" id="content" name="content" rows="5" placeholder="Tulis penjelasan lengkap atau ringkasan keuangan..." required></textarea>
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Gambar Pendukung (Opsional)</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">Format gambar: .jpg, .jpeg, .png (maks 2MB)</small>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-1"></i>Kirim
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Optional Tambahan Style --}}
<style>
    .form-label {
        font-weight: 600;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
    }

    .card-header {
        font-size: 1.1rem;
    }
</style>
@endsection
