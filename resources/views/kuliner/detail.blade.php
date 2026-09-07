@extends('layouts.app_donatur')

@section('title', $kuliner->nama)

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-down">
        <ol class="breadcrumb bg-white px-3 py-2 rounded shadow-sm">
            <li class="breadcrumb-item"><a href="{{ route('donatur.kuliner.index') }}">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $kuliner->nama }}</li>
        </ol>
    </nav>

    <!-- Judul -->
    <h2 class="text-center my-5 text-primary fw-bold" data-aos="zoom-in">{{ $kuliner->nama }}</h2>

    <div class="row g-4">
        <!-- Gambar & Kontak -->
        <div class="col-md-7" data-aos="fade-right">
            <div class="card shadow border-0 h-100">
                <img src="{{ asset('storage/' . $kuliner->gambar) }}" class="card-img-top rounded-top" alt="{{ $kuliner->nama }}" style="max-height: 400px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="text-primary mb-3">Kontak Kami</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ $kuliner->instagram }}" class="btn btn-outline-primary btn-hover" target="_blank"><i class="fab fa-instagram me-1"></i> Instagram</a>
                        <a href="{{ $kuliner->whatsapp }}" class="btn btn-outline-success btn-hover" target="_blank"><i class="fab fa-whatsapp me-1"></i> WhatsApp</a>
                        <a href="{{ $kuliner->tiktok }}" class="btn btn-outline-dark btn-hover" target="_blank"><i class="fab fa-tiktok me-1"></i> TikTok</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Deskripsi -->
        <div class="col-md-5" data-aos="fade-left">
            <div class="card shadow border-0 p-4 h-100">
                <h5 class="text-primary mb-2">Deskripsi</h5>
                <p class="text-muted">{{ $kuliner->deskripsi }}</p>

                <h5 class="text-primary mt-3">Lokasi</h5>
                <div class="ratio ratio-16x9 rounded shadow overflow-hidden mb-2">
                    {!! $kuliner->lokasi !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-5" data-aos="fade-up">
        <a href="{{ route('donatur.kuliner.index') }}" class="btn btn-secondary px-4 py-2">← Kembali ke Daftar Berita</a>
    </div>
</div>

<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true
  });
</script>

<style>
    body {
        background-color: #f8f9fa;
    }

    .breadcrumb a {
        text-decoration: none;
    }

    .btn-hover {
        transition: all 0.3s ease;
    }

    .btn-hover:hover {
        transform: translateY(-2px) scale(1.03);
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .text-primary {
        color: #0d6efd !important;
    }
</style>
@endsection
