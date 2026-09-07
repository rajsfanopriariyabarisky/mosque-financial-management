@extends('layouts.app_adminkit')

@section('title', 'Tambah Berita Baru')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.kuliner.index') }}">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Berita</li>
        </ol>
    </nav>

    <h2 class="text-center mb-4">
        <i class="fas fa-newspaper    me-2 text-primary"></i> Tambah Berita Baru
    </h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.kuliner.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Berita</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Bencana Gempa Bumi" required>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsikan Bencana..." required></textarea>
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-3">
                            <label for="gambar" class="form-label fw-bold">Upload Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar">
                        </div>

                        {{-- Lokasi --}}
                        <div class="mb-3">
                            <label for="lokasi" class="form-label fw-bold">Lokasi (Embed Google Maps)</label>
                            <textarea class="form-control" id="lokasi" name="lokasi" rows="3" placeholder='<iframe src="..." ...>'></textarea>
                            <small class="text-muted">Masukkan embed code dari Google Maps.</small>
                        </div>

                        {{-- Instagram --}}
                        <div class="mb-3">
                            <label for="instagram" class="form-label fw-bold">Instagram</label>
                            <input type="url" class="form-control" id="instagram" name="instagram" placeholder="https://instagram.com/username">
                        </div>

                        {{-- WhatsApp --}}
                        <div class="mb-3">
                            <label for="whatsapp" class="form-label fw-bold">WhatsApp</label>
                            <input type="url" class="form-control" id="whatsapp" name="whatsapp" placeholder="https://wa.me/nomorhp">
                        </div>

                        {{-- TikTok --}}
                        <div class="mb-3">
                            <label for="tiktok" class="form-label fw-bold">TikTok</label>
                            <input type="url" class="form-control" id="tiktok" name="tiktok" placeholder="https://tiktok.com/@username">
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus-circle me-1"></i> Tambah Berita
                            </button>
                            <a href="{{ route('admin.kuliner.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
