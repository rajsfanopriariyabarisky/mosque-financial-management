@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Zakat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('zakat.index') }}">Data Zakat</a></li>
            <li class="breadcrumb-item active">Edit Zakat</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Form Edit Zakat
            </div>
            <div class="card-body">
                <form action="{{ route('zakat.update', $zakat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal:</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $zakat->tanggal }}">
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis:</label>
                        <select name="jenis" class="form-control">
                            <option value="zakat_fitrah" {{ $zakat->jenis == 'zakat_fitrah' ? 'selected' : '' }}>Zakat Fitrah</option>
                            <option value="zakat_maal" {{ $zakat->jenis == 'zakat_maal' ? 'selected' : '' }}>Zakat Maal</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" name="nama" class="form-control" value="{{ $zakat->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat:</label>
                        <textarea name="alamat" class="form-control">{{ $zakat->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan:</label>
                        <textarea name="keterangan" class="form-control">{{ $zakat->keterangan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah:</label>
                        <input type="text" name="jumlah" class="form-control rupiah" value="{{ $zakat->jumlah }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
