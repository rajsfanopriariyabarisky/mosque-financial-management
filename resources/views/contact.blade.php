@extends('layouts.app_home')

@section('title', 'Kontak | Masjid Nurul Ishlah')

@section('content')
<section class="py-5 bg-light text-dark" id="kontak-kami">
    <div class="container">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="display-4 fw-bold text-primary">Kontak Kami</h1>
            <p class="lead text-secondary">Hubungi kami untuk informasi atau kolaborasi lebih lanjut.</p>
        </div>

        <div class="row g-5">
            <!-- Kontak Info -->
            <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.3s">
                <h4 class="text-dark mb-3"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Alamat</h4>
                <p class="fs-6 text-muted">Jl. Kramat Raya No.98, Jakarta Pusat, Indonesia (Universitas BSI)</p>

                <h4 class="text-dark mt-4 mb-3"><i class="fas fa-phone me-2 text-primary"></i>Telepon</h4>
                <p class="fs-6 text-muted">+62 812-3456-7890</p>

                <h4 class="text-dark mt-4 mb-3"><i class="fas fa-envelope me-2 text-primary"></i>Email</h4>
                <p class="fs-6 text-muted">info@nurulishlah.or.id</p>

                <div class="mt-4">
                    <a class="btn btn-outline-primary btn-square rounded-circle me-2" href="https://www.instagram.com/masjidnurulishlah/"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-danger btn-square rounded-circle me-2" href="https://www.instagram.com/masjidnurulishlah/"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-danger btn-square rounded-circle" href="https://www.instagram.com/masjidnurulishlah/"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Google Maps -->
            <div class="col-md-6 wow fadeInRight" data-wow-delay="0.3s">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5575982409536!2d106.84706907577565!3d-6.183622060292576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f41eb7fa807f%3A0x999151cbf6d32e8e!2sUniversitas%20BSI%20Kramat%2098!5e0!3m2!1sid!2sid!4v1718362259264"
                    width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
@endsection
