@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Data Pengajian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Pengajian</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-list me-1"></i>
            Data Pengajian
        </div>
        <div class="card-body">
            <a href="{{ route('pengajian.create') }}" class="btn btn-success mb-2">Tambah Data Pengajian</a>
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
                        @foreach ($pengajian as $item)
                        <tr>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ format_rupiah($item->jumlah) }}</td>
                            @if(auth()->user()->role == 'ketua')
                            <td>
                                <a href="{{ route('pengajian.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('pengajian.destroy', $item->id) }}" method="POST" style="display: inline">
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
