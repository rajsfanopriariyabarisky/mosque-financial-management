@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Operasional</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Operasional</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-database me-1"></i>
            Data Operasional
        </div>
        <div class="card-body">
            @if(auth()->user()->role == 'admin')
            <a href="{{ route('operasional.create') }}" class="btn btn-success mb-2">Tambah Data Operasional</a>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Komentar</th>
                            @if(auth()->user()->role == 'ketua')
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($operasional as $item)
                        <tr>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ format_rupiah($item->jumlah) }}</td>
                            <td>{{ $item->komentar }}</td>
                            @if(auth()->user()->role == 'ketua')
                            <td>
                                <a href="{{ route('operasional.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('operasional.destroy', $item->id) }}" method="POST" style="display: inline">
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
