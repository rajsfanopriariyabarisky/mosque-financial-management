@extends('layouts.app_adminkit')

@section('title', 'Edit RAB')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-edit me-2 text-warning"></i>Edit Rancangan Anggaran Biaya</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('rabs.index') }}">Rancangan Anggaran Biaya</a></li>
        <li class="breadcrumb-item active">Edit Data</li>
    </ol>

    @if($errors->any())
        <div class="alert alert-danger shadow-sm">
            <strong>Oops!</strong> Terdapat kesalahan input:
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0 text-dark">
                <i class="fas fa-pencil-alt me-2 text-warning"></i>Form Edit RAB
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('rabs.update', $rab->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Program:</label>
                    <input type="text" name="nama" class="form-control" value="{{ $rab->nama }}" required>
                </div>

                <div class="mb-3">
                    <label for="periode" class="form-label">Periode:</label>
                    <input type="date" class="form-control" id="periode" name="periode" value="{{ $rab->periode }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Kategori:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kategori" id="pemasukan" value="pemasukan" {{ $rab->kategori == 'pemasukan' ? 'checked' : '' }} onchange="showJenis()" required>
                        <label class="form-check-label" for="pemasukan">Pemasukan</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kategori" id="pengeluaran" value="pengeluaran" {{ $rab->kategori == 'pengeluaran' ? 'checked' : '' }} onchange="showJenis()" required>
                        <label class="form-check-label" for="pengeluaran">Pengeluaran</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis:</label>
                    <select class="form-control" id="jenis" name="jenis" required>
                        <!-- Opsi akan dipilih otomatis via JS -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan:</label>
                    <textarea class="form-control" id="summernote" name="keterangan" rows="5" required>{{ $rab->keterangan }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah (Rp):</label>
                    <input type="text" class="form-control rupiah" id="jumlah" name="jumlah" value="{{ $rab->jumlah }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showJenis() {
        const jenis = document.getElementById('jenis');
        const selectedJenis = '{{ $rab->jenis }}';
        const pemasukanOptions = [
            { value: 'infaq', text: 'Infaq' },
            { value: 'zakat', text: 'Zakat' },
            { value: 'qurban', text: 'Qurban' },
            { value: 'parkir', text: 'Parkir' },
            { value: 'kontribusi', text: 'Kontribusi' },
            { value: 'insidental', text: 'Insidental' }
        ];
        const pengeluaranOptions = [
            { value: 'operasional', text: 'Operasional' },
            { value: 'pengajian', text: 'Pengajian' },
            { value: 'lainnya', text: 'Lainnya' }
        ];

        jenis.innerHTML = '';
        const kategori = document.querySelector('input[name="kategori"]:checked').value;
        const options = kategori === 'pemasukan' ? pemasukanOptions : pengeluaranOptions;

        jenis.appendChild(new Option('-- Pilih Jenis --', '', true, false));
        options.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.value;
            opt.textContent = option.text;
            if (selectedJenis === option.value) opt.selected = true;
            jenis.appendChild(opt);
        });
    }

    // Jalankan saat halaman selesai dimuat untuk set nilai jenis awal
    window.addEventListener('DOMContentLoaded', showJenis);
</script>
@endsection
