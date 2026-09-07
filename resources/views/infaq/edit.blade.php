@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Infaq</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('infaq.index') }}">Data Infaq</a></li>
        <li class="breadcrumb-item active">Edit Infaq</li>
    </ol>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-warning text-dark rounded-top">
            <i class="fas fa-edit me-1"></i> Formulir Edit Infaq
        </div>
        <div class="card-body">
            <form action="{{ route('infaq.update', $infaq->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal"
                               value="{{ $infaq->tanggal }}" required>
                    </div>

                    <div class="col-md-8">
                        <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                        <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required
                                  placeholder="Contoh: Infaq Jumat, sumbangan dll...">{{ $infaq->keterangan }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="jumlah" class="form-label">Jumlah (Rp) <span class="text-danger">*</span></label>
                        <input type="text" name="jumlah" class="form-control rupiah" id="jumlah"
                               value="{{ $infaq->jumlah }}" required placeholder="Contoh: 100000">
                    </div>

                    @if(auth()->user()->role == 'ketua')
                    <div class="col-md-12">
                        <label for="komentar" class="form-label">Komentar Ketua <span class="text-danger">*</span></label>
                        <textarea name="komentar" class="form-control" id="komentar" rows="3" required
                                  placeholder="Masukkan komentar persetujuan atau catatan lainnya...">{{ $infaq->komentar }}</textarea>
                    </div>
                    @endif
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('infaq.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
