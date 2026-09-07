<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran Zakat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bukti Pembayaran Zakat</h1>
        
        <table>
            <tr>
                <th>ID Pembayaran</th>
                <td>{{ $zakatJamaah->id }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $zakatJamaah->nama }}</td>
            </tr>
            <tr>
                <th>Jenis Zakat</th>
                <td>{{ $zakatJamaah->jenis }}</td>
            </tr>
            <tr>
                <th>Sub Jenis</th>
                <td>{{ $zakatJamaah->sub_jenis ?: 'Tidak ada' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $zakatJamaah->alamat ?: 'Tidak ada' }}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>{{ $zakatJamaah->keterangan ?: 'Tidak ada' }}</td>
            </tr>
            <tr>
                <th>Nilai Aset</th>
                <td>{{ format_rupiah($zakatJamaah->nilai_aset) }}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>{{ format_rupiah($zakatJamaah->jumlah) }}</td>
            </tr>
            <tr>
                <th>Tanggal Pembayaran</th>
                <td>{{ $zakatJamaah->tanggal }}</td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td>{{ $zakatJamaah->status_pembayaran }}</td>
            </tr>
        </table>
        
        <p>Terima kasih atas partisipasi Anda dalam membayar zakat.</p>
    </div>
</body>
</html>