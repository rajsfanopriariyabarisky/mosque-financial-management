@extends('layouts.app_donatur')

@section('title', 'Daftar Zakat Jamaah')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-lg">
                    <div class="card-body p-5">
                        <h1 class="mb-4">Daftar Zakat Jamaah</h1>
                        <a href="{{ route('zakat_jamaah.create') }}" class="btn btn-success mb-4">
                            <i class="bi bi-plus-circle me-2">Buat Zakat Baru</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection