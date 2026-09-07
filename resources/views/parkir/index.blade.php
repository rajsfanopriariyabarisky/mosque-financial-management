@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Parkir</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Parkir</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Parkir
            </div>
            <div class="card-body">
                <a href="{{ route('parkir.create') }}" class="btn btn-success mb-2">Tambah Data Parkir</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nomor Kendaraan</th>
                                <th>Jenis Kendaraan</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Biaya</th>
                                @if(auth()->user()->role == 'ketua')
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parkirs as $parkir)
                                <tr>
                                    <td>{{ $parkir->tanggal }}</td>
                                    <td>{{ $parkir->nomor_kendaraan }}</td>
                                    <td>{{ $parkir->jenis_kendaraan }}</td>
                                    <td>{{ $parkir->nama }}</td>
                                    <td>{{ $parkir->keterangan }}</td>
                                    <td>{{ format_rupiah($parkir->jumlah) }}</td>
                                    @if(auth()->user()->role == 'ketua')
                                    <td>
                                        <a href="{{ route('parkir.edit', $parkir->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('parkir.destroy', $parkir->id) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
