@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Edit Lainnya</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lainnya.index') }}">Data Lainnya</a></li>
            <li class="breadcrumb-item active">Edit Lainnya</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit me-1"></i>
                Edit Lainnya
            </div>
            <div class="card-body">
                <form action="{{ route('lainnya.update', $lainnya->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal:</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ $lainnya->tanggal }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan:</label>
                        <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required>{{ $lainnya->keterangan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah:</label>
                        <input type="text" name="jumlah" class="form-control rupiah" id="jumlah" value="{{ $lainnya->jumlah }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
