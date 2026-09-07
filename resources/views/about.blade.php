@extends('layouts.app_home')

@section('title', 'Tentang Kami | Masjid Nurul Ishlah')

@section('content')
<section class="py-5 bg-light" id="tentang-kami">
    <div class="container">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="display-5 text-primary">Tentang Kami</h1>
            <p class="lead">Pusat ibadah dan kegiatan umat – Masjid Nurul Ishlah</p>
        </div>
        <div class="row g-4 align-items-center">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.3s">
                <img src="{{ asset('images/kegiatan-sosial.jpg') }}" alt="Masjid Nurul Ishlah" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                <h3 class="mb-3">Sejarah & Misi</h3>
                <p>Masjid Nurul Ishlah berdiri sejak 1995, menjadi pusat ibadah, pembinaan rohani, serta kegiatan sosial. Masjid ini aktif dalam menyelenggarakan kajian Islam, sedekah, dan kegiatan komunitas lainnya.</p>
                <ul class="list-unstyled mt-3">
                    <li><i class="fas fa-check text-success me-2"></i>Tempat ibadah yang kondusif</li>
                    <li><i class="fas fa-check text-success me-2"></i>Kajian Islami mingguan</li>
                    <li><i class="fas fa-check text-success me-2"></i>Kegiatan sosial untuk masyarakat</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
