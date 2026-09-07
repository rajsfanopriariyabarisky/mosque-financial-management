@extends('layouts.app_donatur')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-body p-5">
                    <h1 class="mb-4">Detail Zakat</h1>

                    <h5 class="card-title">Zakat #{{ $zakatJamaah->id }}</h5>
                    <p class="card-text"><strong>Tanggal:</strong> {{ $zakatJamaah->tanggal }}</p>
                    <p class="card-text"><strong>ID Pembayaran:</strong> {{ $zakatJamaah->order_id }}</p>
                    <p class="card-text"><strong>Nama:</strong> {{ $zakatJamaah->nama }}</p>
                    <p class="card-text"><strong>Jenis Zakat:</strong> {{ $zakatJamaah->jenis }}</p>
                    <p class="card-text"><strong>Sub Jenis:</strong> {{ $zakatJamaah->sub_jenis ?: 'Tidak ada' }}</p>
                    <p class="card-text"><strong>Alamat:</strong> {{ $zakatJamaah->alamat ?: 'Tidak ada' }}</p>
                    <p class="card-text"><strong>Keterangan:</strong> {{ $zakatJamaah->keterangan ?: 'Tidak ada' }}</p>
                    <p class="card-text"><strong>Nilai Aset:</strong> {{ format_rupiah($zakatJamaah->nilai_aset) }}</p>
                    <p class="card-text"><strong>Jumlah:</strong> {{ format_rupiah($zakatJamaah->jumlah) }}</p>
                    <p class="card-text"><strong>Status Pembayaran:</strong> {{ $zakatJamaah->status_pembayaran }}</p>

                    @if($zakatJamaah->status_pembayaran == 'menunggu')
                        <form action="{{ route('zakat_jamaah.store') }}" method="POST" id="payment-form">
                            @csrf
                            <input type="hidden" name="zakat_jamaah_id" value="{{ $zakatJamaah->id }}">
                            <input type="hidden" name="nama" value="{{ $zakatJamaah->nama }}">
                            <input type="hidden" name="jumlah" value="{{ $zakatJamaah->jumlah }}">
                            <button type="submit" class="btn btn-primary mt-3">Lanjutkan Pembayaran</button>
                        </form>
                    @else
                        <a href="{{ route('zakat_jamaah.download_pdf', $zakatJamaah->id) }}" class="btn btn-danger mt-3">Unduh PDF</a>
                    @endif

                    <a href="{{ route('zakat_jamaah.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection