@extends('layouts.app_adminkit')

@section('title', 'Edit Profil')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-primary"><i class="fas fa-user-cog me-2"></i>Edit Profil</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="fas fa-home me-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Profil</li>
        </ol>

        <div class="row">
            <!-- Update Informasi Profil -->
            <div class="col-12 col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="fas fa-id-card me-2 text-primary"></i> Perbarui Informasi Profil
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="col-12 col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="fas fa-lock me-2 text-warning"></i> Perbarui Kata Sandi
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Hapus Akun -->
            <div class="col-12 col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 text-danger">
                            <i class="fas fa-user-slash me-2"></i> Hapus Akun
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
