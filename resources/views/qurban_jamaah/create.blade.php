@extends('layouts.app_donatur')

@section('content')
<div class="container">
    <h2>Tambah Qurban Jamaah</h2>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('qurban_jamaah.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_jamaah">Nama Jamaah</label>
            <input type="text" class="form-control" id="nama_jamaah" name="nama_jamaah" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah (Rp)</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="form-group">
            <label for="jenis_hewan">Jenis Hewan</label>
            <select class="form-control" id="jenis_hewan" name="jenis_hewan" required>
                <option value="Kambing">Kambing</option>
                <option value="Sapi">Sapi</option>
                <option value="Domba">Domba</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
<script>
    new Cleave('#jumlah', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand',
        prefix: 'Rp ',
        delimiter: '.'
    });
</script>
@endpush
@endsection