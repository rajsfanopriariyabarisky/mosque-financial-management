@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-warning fw-bold">
        <i class="fas fa-edit me-2"></i>Edit Laporan Keuangan
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Edit Laporan</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-light fw-semibold">
                    <i class="fas fa-pen me-2"></i>Formulir Edit Data
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

                    {{-- Form --}}
                    <form action="{{ route('dashboard.update', $dashboard->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $dashboard->title }}" required>
                        </div>

                        {{-- Konten --}}
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">Konten</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $dashboard->content }}</textarea>
                        </div>

                        {{-- Upload Gambar --}}
                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Ganti Gambar (Opsional)</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        </div>

                        {{-- Gambar Saat Ini --}}
                        @if($dashboard->image)
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Gambar Saat Ini:</label><br>
                                <img src="{{ asset('images/' . $dashboard->image) }}" class="img-thumbnail rounded-3 shadow-sm" style="max-width: 200px;">
                            </div>
                        @endif

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-warning text-white">
                                <i class="fas fa-save me-1"></i>Perbarui
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Optional Style --}}
<style>
    .form-label {
        font-weight: 600;
    }

    .btn-warning:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.2);
    }

    .img-thumbnail {
        border: 1px solid #ddd;
    }
</style>
@endsection
