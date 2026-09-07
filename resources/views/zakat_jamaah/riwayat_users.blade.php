@extends('layouts.app_donatur')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-body p-5">
                    <h1 class="mb-4">Riwayat Pembayaran Zakat</h1>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>ID Pembayaran</th>
                                    <th>Nama</th>
                                    <th>Jenis Zakat</th>
                                    <th>Jumlah</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayatUsers as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jenis }}</td>
                                    <td>{{ format_rupiah($item->jumlah) }}</td>
                                    <td>{{ $item->status_pembayaran }}</td>
                                    <td>
                                        <a href="{{ route('zakat_jamaah.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $riwayatUsers->links('pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection