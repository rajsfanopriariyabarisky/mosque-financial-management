@extends('layouts.app_donatur')

@section('content')
<div class="container">
    <h2>Input Data Zakat</h2>
    <form action="{{ route('zakat_jamaah.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jenis">Jenis Zakat</label>
            <select name="jenis" id="jenis" class="form-control" required>
                <option value="zakat_fitrah">Zakat Fitrah</option>
                <option value="zakat_maal">Zakat Maal</option>
            </select>
        </div>
        <div id="subJenisContainer" class="form-group" style="display: none;">
            <label for="sub_jenis">Sub Jenis Zakat Maal</label>
            <select name="sub_jenis" id="sub_jenis" class="form-control">
                <option value="emas">Emas</option>
                <option value="perak">Perak</option>
                <option value="penghasilan">Penghasilan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control">
        </div>
        <div id="nilaiAsetContainer" class="form-group" style="display: none;">
            <label for="nilai_aset">Nilai Aset</label>
            <input type="text" name="nilai_aset" id="nilai_aset" class="form-control rupiah">
            <button type="button" id="hitungZakatMaal" class="btn btn-primary mt-2">Hitung Zakat Maal</button>
            <div id="nisabMessage" class="text-danger mt-2" style="display: none;"></div>
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah Zakat (Rp)</label>
            <input type="text" name="jumlah" id="jumlah" class="form-control rupiah" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function () {
        $('.rupiah').mask("#.##0", { reverse: true });

        $('#jenis').change(function () {
            const jenisZakat = $(this).val();
            if (jenisZakat === 'zakat_maal') {
                $('#subJenisContainer').show();
                $('#nilaiAsetContainer').show();
                $('#jumlah').attr('readonly', true).val('');
                $('#keterangan').val('');
                $('#nisabMessage').hide();
            } else {
                $('#subJenisContainer').hide();
                $('#nilaiAsetContainer').hide();
                $('#jumlah').attr('readonly', false).val('');
                $('#keterangan').val('');
                $('#nisabMessage').hide();
            }
        });

        $('#hitungZakatMaal').click(function () {
            calculateZakatMaal();
        });

        $('#jumlah').on('input', function () {
            if ($('#jenis').val() === 'zakat_fitrah') {
                calculateZakatFitrah();
            }
        });

        function calculateZakatMaal() {
            const subJenis = $('#sub_jenis').val();
            const nilaiAsetStr = $('#nilai_aset').val().replace(/\./g, '');
            const nilaiAset = parseInt(nilaiAsetStr);

            if (!nilaiAset || nilaiAset <= 0) {
                $('#jumlah').val('');
                return;
            }

            let jumlahZakat = 0;
            let nisabZakat = 0;

            switch (subJenis) {
                case 'emas':
                    nisabZakat = 82312725;
                    if (nilaiAset >= nisabZakat) {
                        jumlahZakat = nilaiAset * 0.025;
                    }
                    break;
                case 'perak':
                    nisabZakat = 6545000;
                    if (nilaiAset >= nisabZakat) {
                        jumlahZakat = nilaiAset * 0.025;
                    }
                    break;
                case 'penghasilan':
                    nisabZakat = 6859394;
                    if (nilaiAset >= nisabZakat) {
                        jumlahZakat = nilaiAset * 0.025;
                    }
                    break;
            }

            if (jumlahZakat > 0) {
                $('#jumlah').val(Math.round(jumlahZakat).toLocaleString('id-ID'));
                $('#nisabMessage').hide();
            } else {
                $('#jumlah').val('');
                $('#nisabMessage').show().text(`Total harta belum mencapai nisab zakat. Nisab Zakat: Rp. ${nisabZakat.toLocaleString('id-ID')}`);
            }
        }

        function calculateZakatFitrah() {
            const jumlahStr = $('#jumlah').val().replace(/\./g, '');
            const jumlah = parseInt(jumlahStr);

            if (!jumlah || jumlah % 35000 !== 0) {
                $('#keterangan').val('');
                return;
            }

            const jumlahJiwa = jumlah / 35000;
            $('#keterangan').val(`Jumlah jiwa: ${jumlahJiwa}`);
        }
    });
</script>
@endsection
