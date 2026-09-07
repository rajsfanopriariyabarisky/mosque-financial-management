@extends('layouts.app_adminkit')

@section('title', 'Data Donatur')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-hand-holding-heart text-danger me-2"></i>Data Donatur</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Donatur</li>
    </ol>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-light fw-bold">
            <i class="fas fa-users me-1 text-secondary"></i> Daftar Donatur
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @if($user->role == 'user')
                                @php
                                    $phoneNumber = preg_replace('/[^0-9]/', '', $user->nomor_telepon);
                                    if (substr($phoneNumber, 0, 1) === '0') {
                                        $phoneNumber = '62' . substr($phoneNumber, 1);
                                    }
                                    $message = "Halo {$user->name}, ini adalah pengingat untuk donasi bulanan Anda. Terima kasih atas dukungan Anda yang terus menerus!";
                                @endphp
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->jenis_kelamin) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d M Y') }}</td>
                                    <td>{{ $user->nomor_telepon }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td class="text-center">
                                        <div class="d-grid gap-2">
                                            <a href="https://wa.me/{{ $phoneNumber }}?text={{ urlencode($message) }}"
                                               target="_blank"
                                               class="btn btn-success btn-sm">
                                                <i class="fab fa-whatsapp me-1"></i> Kirim WA
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus donatur ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
