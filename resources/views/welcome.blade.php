@extends('layouts.app_home')

@section('title', 'Beranda')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('images/masjidishlah.jpg') }}" alt="Masjid Nurul Ishlah" style="width: 100%; height: 100vh; object-fit: cover;">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                                <p class="text-primary text-uppercase fw-bold mb-2">Selamat Datang</p>
                                <h1 class="display-1 text-light mb-4 animated slideInDown">di Masjid Nurul Ishlah</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add more carousel items if needed -->
        </div>
    </div>
    <!-- Carousel End -->

<!-- Jadwal Sholat Start -->
<div id="jadwal-sholat" class="container-xxl py-5 wow fadeInDown" data-wow-delay="0.2s">
    <div class="container text-center mx-auto mb-4" style="max-width:600px;">
      <p class="text-primary text-uppercase mb-2">Jadwal Sholat</p>
      <h2 class="display-6">Waktu Sholat Hari Ini – Jakarta</h2>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-12 text-center">
        <div class="spinner-border text-primary" role="status"></div>
      </div>
    </div>
  </div>
  <!-- Jadwal Sholat End -->

    <!-- About Start -->
    <div id="tentang-kami" class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="{{ asset('images/masjidishlah.jpg') }}" alt="Interior Masjid">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="https://plus.unsplash.com/premium_photo-1678483063222-b9cbc116b371?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bW9zcXVlfGVufDB8fDB8fHww" alt="Eksterior Masjid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <p class="text-primary text-uppercase mb-2">Tentang Kami</p>
                        <h1 class="display-6 mb-4">Masjid Nurul Ishlah: Pusat Ibadah dan Ilmu</h1>
                        <p>Masjid Nurul Ishlah berdiri sejak tahun 1995 dan telah menjadi pusat kegiatan ibadah dan pendidikan Islam di wilayah kami. Kami berkomitmen untuk menyediakan lingkungan yang nyaman dan inspiratif bagi jamaah untuk beribadah dan menuntut ilmu.</p>
                        <p>Dengan berbagai program dan fasilitas yang kami miliki, kami berupaya untuk terus memakmurkan masjid dan memberikan manfaat bagi masyarakat sekitar.</p>
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Sholat Berjamaah
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Kajian Rutin
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Pendidikan Al-Quran
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Program Sosial
                            </div>
                        </div>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="/tentang-kami">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Programs Start -->
    <div class="container-xxl bg-light my-6 py-6 pt-0">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">Program Unggulan</p>
                <h1 class="display-6 mb-4">Kegiatan Utama di Masjid Nurul Ishlah</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="program-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                        <div class="text-center p-4">
                            <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">Senin - Jumat</div>
                            <h3 class="mb-3">Tahsin Al-Quran</h3>
                            <span>Program belajar membaca Al-Quran dengan tajwid yang benar untuk semua usia</span>
                        </div>
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="https://images.unsplash.com/photo-1651293478838-1f51675131c5?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Y2VyYW1haHxlbnwwfHwwfHx8MA%3D%3D" alt="Tahsin Al-Quran">
                            <div class="program-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="program-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                        <div class="text-center p-4">
                            <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">Jumat - Minggu</div>
                            <h3 class="mb-3">Kajian Ilmu Agama</h3>
                            <span>Kegiatan pembelajaran agama Islam yang rutin diadakan di masjid</span>
                        </div>
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="{{ asset('images/bersama.jpg') }}" alt="Kajian Ilmu Agama">
                            <div class="program-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="program-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                        <div class="text-center p-4">
                            <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">Sabtu</div>
                            <h3 class="mb-3">Kegiatan Sosial</h3>
                            <span>Membersihkan masjid bersama warga sekitar</span>
                        </div>
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="{{ asset('images/kegiatan-sosial.jpg') }}" alt="Kegiatan Sosial">
                            <div class="program-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add more program items as needed -->
            </div>
        </div>
    </div>
    <!-- Programs End -->

    <!-- Services Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="text-primary text-uppercase mb-2">Layanan Kami</p>
                    <h1 class="display-6 mb-4">Apa yang Kami Tawarkan untuk Umat?</h1>
                    <p class="mb-5">Kami menghadirkan masjid sebagai pusat ibadah, pendidikan, dan kegiatan sosial umat Islam. Mulai dari shalat berjamaah, kajian ilmu, TPA anak-anak, hingga layanan zakat dan santunan sosial. Semua kegiatan bertujuan membina keimanan, mempererat ukhuwah, dan memberdayakan masyarakat.</p>
                    <div class="row gy-5 gx-4">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-mosque text-white"></i>
                                </div>
                                <h5 class="mb-0">Sholat Berjamaah</h5>
                            </div>
                            <span>Lima waktu sholat berjamaah setiap hari</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-quran text-white"></i>
                                </div>
                                <h5 class="mb-0">Kajian Islam</h5>
                            </div>
                            <span>Kajian rutin mingguan dengan berbagai tema</span>
                        </div>
                        <!-- Add more service items as needed -->
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="{{ asset('images/bersama.jpg') }}" alt="Layanan 1">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="{{ asset('images/sholat.jpg') }}" alt="Layanan 2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
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
        <div class="col-md-2 col-sm-4 col-6 wow fadeInUp" data-wow-delay="${0.1 + idx * 0.1}s">
          <div class="text-center border rounded p-3 bg-light shadow-sm h-100">
            <i class="fas ${it.i} fa-2x text-primary mb-2"></i>
            <h6>${it.n}</h6>
            <strong>${it.t}</strong>
          </div>
        </div>
      `).join("");

      const container = document.querySelector("#jadwal-sholat .row");
      container.innerHTML = html;
    })
    .catch(err => {
      console.error("Error fetch jadwal:", err);
      document.querySelector("#jadwal-sholat .row").innerHTML =
        `<div class="col-12"><p class="text-danger text-center">⚠️ Gagal memuat jadwal sholat.</p></div>`;
    });
});
</script>
@endpush
