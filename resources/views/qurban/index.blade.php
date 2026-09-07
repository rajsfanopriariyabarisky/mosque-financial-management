@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Qurban</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Qurban</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabel Data Qurban
            </div>
            <div class="card-body">
                @if(auth()->user()->role == 'admin')
                <a href="{{ route('qurban.create') }}" class="btn btn-success mb-2">Tambah Data Qurban</a>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kelompok</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Komentar</th>
                                @if(auth()->user()->role == 'ketua')
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($qurbans as $qurban)
                                <tr>
                                    <td>{{ $qurban->tanggal }}</td>
                                    <td>{{ $qurban->kelompok }}</td>
                                    <td>{{ $qurban->keterangan }}</td>
                                    <td>{{ format_rupiah($qurban->jumlah) }}</td>
                                    <td>{{ $qurban->komentar }}</td>
                                    @if(auth()->user()->role == 'ketua')
                                    <td>
                                        <a href="{{ route('qurban.edit', $qurban->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('qurban.destroy', $qurban->id) }}" method="POST" style="display: inline">
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
