@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Kontribusi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Kontribusi</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Kontribusi
        </div>
        <div class="card-body">
            <a href="{{ route('kontribusi.create') }}" class="btn btn-success mb-2">Tambah Data Kontribusi</a>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            @if(auth()->user()->role == 'ketua')
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kontribusis as $kontribusi)
                            <tr>
                                <td>{{ $kontribusi->tanggal }}</td>
                                <td>{{ $kontribusi->keterangan }}</td>
                                <td>{{ format_rupiah($kontribusi->jumlah) }}</td>
                                @if(auth()->user()->role == 'ketua')
                                <td>
                                    <a href="{{ route('kontribusi.edit', $kontribusi->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('kontribusi.destroy', $kontribusi->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
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
