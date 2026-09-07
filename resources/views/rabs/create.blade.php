@extends('layouts.app_adminkit')

@section('title', 'Rancangan Anggaran Biaya')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-file-invoice-dollar me-2 text-primary"></i>Buat Rancangan Anggaran Biaya</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('rabs.index') }}">Rancangan Anggaran Biaya</a></li>
        <li class="breadcrumb-item active">Tambah Data</li>
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
                <i class="fas fa-plus-circle me-2 text-success"></i>Form Tambah RAB
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('rabs.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Program:</label>
                    <input type="text" name="nama" class="form-control" placeholder="Contoh: Renovasi Masjid" required>
                </div>

                <div class="mb-3">
                    <label for="periode" class="form-label">Periode:</label>
                    <input type="date" class="form-control" id="periode" name="periode" required>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Kategori:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kategori" id="pemasukan" value="pemasukan" onchange="showJenis()" required>
                        <label class="form-check-label" for="pemasukan">Pemasukan</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kategori" id="pengeluaran" value="pengeluaran" onchange="showJenis()" required>
                        <label class="form-check-label" for="pengeluaran">Pengeluaran</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis:</label>
                    <select class="form-control" id="jenis" name="jenis" required>
                        <option selected disabled value="">-- Pilih Kategori Terlebih Dahulu --</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan:</label>
                    <textarea class="form-control" id="summernote" name="keterangan" rows="5" placeholder="Tuliskan detail kegiatan atau penggunaan dana..." required></textarea>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah (Rp):</label>
                    <input type="text" class="form-control rupiah" id="jumlah" name="jumlah" placeholder="Contoh: 1.000.000" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-paper-plane me-1"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showJenis() {
        const jenis = document.getElementById('jenis');
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

        jenis.appendChild(new Option('-- Pilih Jenis --', '', true, true));
        options.forEach(option => {
            jenis.appendChild(new Option(option.text, option.value));
        });
    }
</script>
@endsection
