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
                        <i class="fas fa-credit-card me-2"></i>Pembayaran Donasi
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

                    {{-- Detail Donasi --}}
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><strong>ID Donasi:</strong> #{{ $donasi->id }}</li>
                        <li class="list-group-item"><strong>Tanggal:</strong> {{ $donasi->tanggal }}</li>
                        <li class="list-group-item"><strong>ID Pembayaran:</strong> {{ $donasi->order_id }}</li>
                        <li class="list-group-item"><strong>Nama Donatur:</strong> {{ $donasi->nama_donatur }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $donasi->email }}</li>
                        <li class="list-group-item"><strong>Jumlah:</strong> {{ format_rupiah($donasi->jumlah) }}</li>
                    </ul>

                    {{-- Tombol Bayar --}}
                    <button id="pay-button" class="btn btn-lg btn-success w-100 mt-3">
                        <i class="fas fa-money-check-alt me-2"></i>Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Midtrans Snap JS --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                verifyPayment(result);
            },
            onPending: function(result) {
                alert("Menunggu pembayaran!");
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
            },
            onClose: function() {
                alert('Anda menutup popup tanpa menyelesaikan pembayaran.');
            }
        });
    });

    function verifyPayment(result) {
        fetch('{{ route("donasi.verify", $donasi->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(result)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Pembayaran berhasil! Status: " + data.status);
                window.location.href = '{{ route("donasi.index") }}';
            } else {
                alert("Verifikasi gagal: " + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Terjadi kesalahan saat memverifikasi pembayaran.");
        });
    }
</script>

{{-- Opsional: AOS + Animasi --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 800, once: true });</script>

{{-- Style tambahan --}}
<style>
    .list-group-item strong {
        min-width: 150px;
        display: inline-block;
    }

    .btn {
        transition: 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }
</style>
@endsection
