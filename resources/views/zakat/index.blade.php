@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Zakat</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Zakat</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Zakat
        </div>
        <div class="card-body">
            @if(auth()->user()->role == 'admin')
            <div class="d-flex justify-content-start mb-2">
                <a href="{{ route('zakat.create') }}" class="btn btn-success">Tambah Zakat</a>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Keterangan</th>
                            <th>Komentar</th>
                            <th class="text-end">Jumlah</th>
                            @if(auth()->user()->role == 'ketua')
                            <th class="text-center">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($zakats as $zakat)
                            <tr>
                                <td>{{ $zakat->tanggal }}</td>
                                <td>{{ $zakat->jenis }}</td>
                                <td>{{ $zakat->nama }}</td>
                                <td>{{ $zakat->alamat }}</td>
                                <td>{{ $zakat->keterangan }}</td>
                                <td>{{ $zakat->komentar }}</td>
                                <td class="text-end">{{ format_rupiah($zakat->jumlah) }}</td>
                                @if(auth()->user()->role == 'ketua')
                                <td class="text-center">
                                    <a href="{{ route('zakat.edit', $zakat->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('zakat.destroy', $zakat->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
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
