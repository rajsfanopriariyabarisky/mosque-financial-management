@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Data Parkir</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('parkir.index') }}">Data Parkir</a></li>
        <li class="breadcrumb-item active">Tambah Data Parkir</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus-circle me-1"></i>
            Tambah Data Parkir
        </div>
        <div class="card-body">
            <form action="{{ route('parkir.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tanggal" class="form-label">Tanggal:</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nomor_kendaraan" class="form-label">Nomor Kendaraan:</label>
                            <input type="text" name="nomor_kendaraan" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan:</label>
                            <input type="text" name="jenis_kendaraan" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama:</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan" class="form-label">Keterangan:</label>
                            <textarea name="keterangan" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jumlah" class="form-label">Biaya:</label>
                            <input type="text" name="jumlah" class="form-control rupiah" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
