@extends('layouts.app_donatur')

@section('title', 'Selamat Datang di Masjid Nurul Ishlah')

@section('content')

<!-- Hero Section -->
<header class="py-5 position-relative overflow-hidden" style="background: linear-gradient(rgba(0, 128, 0, 0.1), rgba(255,255,255,0.95));">
    <!-- Gambar Background -->
    <img src="{{ asset('images/masjidishlah.jpg') }}" alt="Masjid Background"
         class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: -2; opacity: 0.15;">
    <!-- Mask Blur -->
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-white" style="opacity: 0.3; backdrop-filter: blur(5px); z-index: -1;"></div>

    <div class="container px-4">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" data-aos="fade-down" data-aos-delay="100">
                    <div class="card-body p-5">
                        <h1 class="display-4 fw-bold text-success mb-3">
                            <span id="typing-title" class="d-inline-block"></span>
                        </h1>
                        <p class="lead mb-4 text-dark" data-aos="fade-up" data-aos-delay="300">
                            Selamat datang di portal donasi Masjid Nurul Ishlah. Terima kasih atas dukungan Anda.
                        </p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-start" data-aos="zoom-in-up" data-aos-delay="400">
                            <a class="btn btn-success btn-lg px-4 me-sm-3 rounded-pill animate__animated animate__pulse animate__infinite"
                               href="{{ route('donasi.index') }}">
                                <i class="bi bi-heart-fill me-2"></i> Donasi Sekarang
                            </a>
                            <a class="btn btn-outline-success btn-lg px-4 rounded-pill"
                               href="{{ route('donasi.riwayat_users') }}">
                                <i class="bi bi-clock-history me-2"></i> Riwayat Donasi Anda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Jadwal Sholat -->
<section class="py-5 bg-light">
    <div id="jadwal-sholat" class="container-xxl py-5" data-aos="fade-up" data-aos-delay="100">
        <div class="container text-center mx-auto mb-4" style="max-width:600px;">
            <p class="text-success text-uppercase mb-2">Jadwal Sholat</p>
            <h2 class="display-6">Waktu Sholat Hari Ini – Jakarta</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-12 text-center">
                <div class="spinner-border text-success" role="status"></div>
            </div>
        </div>
    </div>

    <!-- Quote -->
    <div class="container px-4 mt-5" data-aos="zoom-in" data-aos-delay="200">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="card border-0 shadow-sm rounded-4 bg-white">
                    <div class="card-body p-5">
                        <i class="bi bi-quote display-1 text-success mb-3" data-aos="fade-in" data-aos-delay="300"></i>
                        <h2 class="mb-4 text-dark fst-italic lh-base" data-aos="fade-up" data-aos-delay="400">
                            "Perumpamaan orang yang menginfakkan hartanya di jalan Allah seperti sebutir biji yang menumbuhkan tujuh tangkai,
                            pada setiap tangkai ada seratus biji..."
                        </h2>
                        <p class="lead mb-0 text-muted" data-aos="fade-up" data-aos-delay="500">– QS. Al-Baqarah: 261</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<!-- AOS & Animate CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Typing JS -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<script>
  // Inisialisasi AOS
  AOS.init({
    duration: 1000,
    offset: 120,
    easing: 'ease-in-out',
    mirror: true,
    once: false
  });

  // Typing Effect
  document.addEventListener("DOMContentLoaded", () => {
    // Replace with your dynamic name
    const username = "{{ Auth::user()->name }}";
    new Typed("#typing-title", {
      strings: [`Assalamu'alaikum, ${username}!`],
      typeSpeed: 50,
      backSpeed: 30,
      showCursor: false,
      loop: false
    });

    // Jadwal Sholat
    const city = "Jakarta";
    const country = "Indonesia";

    fetch(`https://api.aladhan.com/v1/timingsByCity?city=${city}&country=${country}&method=2`)
      .then(res => res.json())
      .then(data => {
        const t = data.data.timings;
        const arr = [
          {n: 'Subuh', t: t.Fajr, i: 'fa-moon'},
          {n: 'Dzuhur', t: t.Dhuhr, i: 'fa-sun'},
          {n: 'Ashar', t: t.Asr, i: 'fa-cloud-sun'},
          {n: 'Maghrib', t: t.Maghrib, i: 'fa-sunset'},
          {n: 'Isya', t: t.Isha, i: 'fa-moon-stars'},
        ];

        const html = arr.map((it, idx) => `
          <div class="col-md-2 col-sm-4 col-6" data-aos="fade-up" data-aos-delay="${100 + idx * 100}">
            <div class="text-center border rounded p-3 bg-white shadow-sm h-100">
              <i class="fas ${it.i} fa-2x text-success mb-2"></i>
              <h6>${it.n}</h6>
              <strong>${it.t}</strong>
            </div>
          </div>
        `).join("");

        const container = document.querySelector("#jadwal-sholat .row");
        container.innerHTML = html;

        AOS.refresh(); // refresh AOS setelah load jadwal
      })
      .catch(err => {
        console.error("Error fetch jadwal:", err);
        document.querySelector("#jadwal-sholat .row").innerHTML =
          `<div class="col-12"><p class="text-danger text-center">⚠️ Gagal memuat jadwal sholat.</p></div>`;
      });
  });
</script>
@endpush
