@extends('layouts.app_donatur')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-body p-5">
                    <h1 class="mb-4">Pembayaran Zakat</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h5 class="card-title">Zakat #{{ $zakatJamaah->id }}</h5>
                    <p class="card-text"><strong>Tanggal:</strong> {{ $zakatJamaah->tanggal }}</p>
                    <p class="card-text"><strong>ID Pembayaran:</strong> {{ $zakatJamaah->order_id }}</p>
                    <p class="card-text"><strong>Nama:</strong> {{ $zakatJamaah->nama }}</p>
                    <p class="card-text"><strong>Jenis Zakat:</strong> {{ $zakatJamaah->jenis }}</p>
                    <p class="card-text"><strong>Jumlah:</strong> {{ format_rupiah($zakatJamaah->jumlah) }}</p>

                    <button id="pay-button" class="btn btn-success mt-4">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan script Midtrans -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
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
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });

    function verifyPayment(result) {
        fetch('{{ route("zakat_jamaah.verify_payment", $zakatJamaah->id) }}', {
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
                window.location.href = '{{ route("zakat_jamaah.index") }}';
            } else {
                alert("Terjadi kesalahan saat memverifikasi pembayaran: " + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Terjadi kesalahan saat memverifikasi pembayaran.");
        });
    }
</script>

@endsection