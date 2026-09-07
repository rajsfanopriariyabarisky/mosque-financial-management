@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Data Parkir</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('parkir.index') }}">Data Parkir</a></li>
        <li class="breadcrumb-item active">Edit Data Parkir</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Edit Data Parkir
        </div>
        <div class="card-body">
            <form action="{{ route('parkir.update', $parkir->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tanggal" class="form-label">Tanggal:</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $parkir->tanggal }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nomor_kendaraan" class="form-label">Nomor Kendaraan:</label>
                            <input type="text" name="nomor_kendaraan" class="form-control" value="{{ $parkir->nomor_kendaraan }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan:</label>
                            <input type="text" name="jenis_kendaraan" class="form-control" value="{{ $parkir->jenis_kendaraan }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama:</label>
                            <input type="text" name="nama" class="form-control" value="{{ $parkir->nama }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan" class="form-label">Keterangan:</label>
                            <textarea name="keterangan" class="form-control">{{ $parkir->keterangan }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jumlah" class="form-label">Biaya:</label>
                            <input type="text" name="jumlah" class="form-control rupiah" value="{{ $parkir->jumlah }}" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
