@extends('layouts.app_donatur')

@section('content')
<div class="container mt-5 mb-5">
    <!-- Gambar di belakang -->
    <img src="{{ asset('images/masjidishlah.jpg') }}" alt="Background Donasi"
         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                object-fit: cover; z-index: -1; opacity: 0.2;">

    <!-- Konten di atas gambar -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4" data-aos="fade-up">
                <div class="card-body p-5">
                    <h1 class="mb-4 text-success fw-bold">
                        <i class="fas fa-hand-holding-heart me-2"></i>Buat Donasi Baru
                    </h1>

                    {{-- Alert Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5 class="mb-2"><i class="fas fa-exclamation-circle me-2"></i>Terjadi Kesalahan:</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    {{-- Form Donasi --}}
                    <form action="{{ route('donasi.store') }}" method="POST">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="nama_donatur" class="form-label">Nama Donatur</label>
                            <div class="form-control-plaintext">{{ Auth::user()->name }}</div>
                            <input type="hidden" name="nama_donatur" value="{{ Auth::user()->name }}">
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="form-control-plaintext">{{ Auth::user()->email }}</div>
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                        </div>

                        {{-- Jumlah --}}
                        <div class="mb-4">
                            <label for="jumlah" class="form-label">Jumlah Donasi (Rp)</label>
                            <input type="text" class="form-control rupiah-input" id="jumlah" name="jumlah" placeholder="Contoh: 1000" required>
                        </div>

                        <button type="submit" class="btn btn-lg btn-success w-100">
                            <i class="fas fa-donate me-2"></i>Buat Donasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Format input rupiah --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rupiahInput = document.querySelector('.rupiah-input');

        rupiahInput.addEventListener('input', function () {
            let value = this.value.replace(/\D/g, '');
            this.value = formatRupiah(value);
        });

        function formatRupiah(angka) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa  = split[0].length % 3,
                rupiah  = split[0].substr(0, sisa),
                ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }
    });
</script>

{{-- Opsional: AOS + Animasi --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 800, once: true });</script>

{{-- Optional Styling --}}
<style>
    .form-label {
        font-weight: 600;
    }

    .form-control-plaintext {
        padding: 0.375rem 0;
        font-weight: 500;
    }

    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 128, 0, 0.3);
    }
</style>
@endsection
