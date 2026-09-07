@extends('layouts.app_adminkit')

@section('title', 'Manage Berita')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage berita</li>
        </ol>
    </nav>
    <h1 class="text-center mb-4">Manage berita</h1>
    <a href="{{ route('admin.kuliner.create') }}" class="btn btn-success mb-3">Add New berita</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kuliners as $kuliner)
                <tr>
                    <td>{{ $kuliner->id }}</td>
                    <td>{{ $kuliner->nama }}</td>
                    <td>{{ $kuliner->deskripsi }}</td>
                    <td>
                        @if ($kuliner->gambar)
                            <img src="{{ asset('storage/' . $kuliner->gambar) }}" alt="{{ $kuliner->nama }}" style="width: 100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.kuliner.edit', $kuliner->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.kuliner.destroy', $kuliner->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
