@extends('layouts.app_donatur')

@section('title', 'Berita')

@section('content')
<div class="container mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" data-aos="fade-down">
        <ol class="breadcrumb bg-light p-2 rounded shadow-sm">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Berita</li>
        </ol>
    </nav>

    <!-- Judul -->
    <h1 class="text-center mb-5 text-primary fw-bold" data-aos="zoom-in">Berita </h1>

    <!-- Pencarian -->
    <div class="row mb-5 justify-content-center" data-aos="fade-up">
        <div class="col-md-8">
            <form action="{{ route('donatur.kuliner.index') }}" method="GET">
                <div class="input-group shadow-sm">
                    <input type="text" name="search" class="form-control form-control-lg rounded-start" placeholder="Cari Berita..." value="{{ request()->query('search') }}">
                    <button class="btn btn-primary px-4 rounded-end" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Kuliner -->
    <div class="row g-4">
        @forelse ($kuliners as $kuliner)
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="card shadow border-0 h-100 card-hover">
                <img src="{{ asset('storage/' . $kuliner->gambar) }}" class="card-img-top" alt="{{ $kuliner->nama }}" style="height: 220px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary">{{ $kuliner->nama }}</h5>
                    <p class="card-text text-muted flex-grow-1">{{ \Illuminate\Support\Str::limit($kuliner->deskripsi, 100) }}</p>
                    <a href="{{ route('donatur.kuliner.show', $kuliner->id) }}" class="btn btn-outline-primary mt-2">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12" data-aos="fade-up">
            <div class="alert alert-warning text-center shadow-sm">
                Pencarian tidak ditemukan.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
        {{ $kuliners->links() }}
    </div>
</div>

<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000, once: true });
</script>

<!-- Custom Style -->
<style>
    .card-hover {
        transition: all 0.3s ease-in-out;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .breadcrumb a {
        text-decoration: none;
    }

    .form-control:focus,
    .btn:focus {
        box-shadow: none;
    }

    .text-primary {
        color: #0d6efd !important;
    }
</style>
@endsection
