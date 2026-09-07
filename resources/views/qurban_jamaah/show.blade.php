@extends('layouts.app_donatur')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-body p-5">
                    <h1 class="mb-4">Detail Qurban Jamaah</h1>

                    <h5 class="card-title">Qurban Jamaah #{{ $qurbanJamaah->id }}</h5>
                    <p class="card-text"><strong>Tanggal:</strong> {{ $qurbanJamaah->tanggal }}</p>
                    <p class="card-text"><strong>ID Pembayaran:</strong> {{ $qurbanJamaah->order_id }}</p>
                    <p class="card-text"><strong>Nama Jamaah:</strong> {{ $qurbanJamaah->nama_jamaah }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $qurbanJamaah->email }}</p>
                    <p class="card-text"><strong>Jumlah:</strong> {{ format_rupiah($qurbanJamaah->jumlah) }}</p>
                    <p class="card-text"><strong>Jenis Hewan:</strong> {{ $qurbanJamaah->jenis_hewan }}</p>
                    <p class="card-text"><strong>Status Pembayaran:</strong> {{ $qurbanJamaah->status_pembayaran }}</p>

                    @if($qurbanJamaah->status_pembayaran == 'menunggu')
                        <form action="{{ route('qurban_jamaah.store') }}" method="POST" id="payment-form">
                            @csrf
                            <input type="hidden" name="qurban_jamaah_id" value="{{ $qurbanJamaah->id }}">
                            <input type="hidden" name="nama_jamaah" value="{{ $qurbanJamaah->nama_jamaah }}">
                            <input type="hidden" name="email" value="{{ $qurbanJamaah->email }}">
                            <input type="hidden" name="jumlah" value="{{ $qurbanJamaah->jumlah }}">
                            <input type="hidden" name="jenis_hewan" value="{{ $qurbanJamaah->jenis_hewan }}">
                            <button type="submit" class="btn btn-primary mt-3">Lanjutkan Pembayaran</button>
                        </form>
                    @else
                        <a href="{{ route('qurban_jamaah.download_pdf', $qurbanJamaah->id) }}" class="btn btn-danger mt-3">Unduh PDF</a>
                    @endif

                    <a href="{{ route('qurban_jamaah.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection