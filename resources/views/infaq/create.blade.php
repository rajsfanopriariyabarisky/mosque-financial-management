@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Infaq</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('infaq.index') }}">Data Infaq</a></li>
        <li class="breadcrumb-item active">Tambah Infaq</li>
    </ol>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top">
            <i class="fas fa-plus-circle me-1"></i> Formulir Tambah Infaq
        </div>
        <div class="card-body">
            <form action="{{ route('infaq.store') }}" method="POST" novalidate>
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                    </div>

                    <div class="col-md-8">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan" rows="3"
                                  placeholder="Contoh: Infaq Jumat, Sumbangan dll..."></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="jumlah" class="form-label">Jumlah (Rp) <span class="text-danger">*</span></label>
                        <input type="text" name="jumlah" class="form-control rupiah" id="jumlah"
                               placeholder="Contoh: 100000" required>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('infaq.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
