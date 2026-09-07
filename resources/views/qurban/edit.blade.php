@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Data Qurban</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('qurban.index') }}">Data Qurban</a></li>
            <li class="breadcrumb-item active">Edit Data Qurban</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Form Edit Data Qurban
            </div>
            <div class="card-body">
                <form action="{{ route('qurban.update', $qurban->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal:</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $qurban->tanggal }}">
                    </div>
                    <div class="mb-3">
                        <label for="kelompok" class="form-label">Kelompok:</label>
                        <input type="text" name="kelompok" class="form-control" value="{{ $qurban->kelompok }}">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan:</label>
                        <textarea name="keterangan" class="form-control">{{ $qurban->keterangan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah:</label>
                        <input type="text" name="jumlah" class="form-control rupiah" value="{{ $qurban->jumlah }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
