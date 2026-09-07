@extends('layouts.app_donatur')

@section('content')
<div class="container">
    <h2>Daftar Qurban Jamaah</h2>
    <a href="{{ route('qurban_jamaah.create') }}" class="btn btn-primary mb-3">Tambah Qurban Jamaah</a>
</div>
@endsection