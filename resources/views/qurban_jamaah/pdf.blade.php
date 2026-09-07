<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran Qurban Jamaah</title>
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
        <h1>Bukti Pembayaran Qurban Jamaah</h1>
        
        <table>
            <tr>
                <th>ID Pembayaran</th>
                <td>{{ $qurbanJamaah->id }}</td>
            </tr>
            <tr>
                <th>Nama Jamaah</th>
                <td>{{ $qurbanJamaah->nama_jamaah }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $qurbanJamaah->email }}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp {{ number_format($qurbanJamaah->jumlah, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Jenis Hewan</th>
                <td>{{ $qurbanJamaah->jenis_hewan }}</td>
            </tr>
            <tr>
                <th>Tanggal Pembayaran</th>
                <td>{{ $qurbanJamaah->tanggal }}</td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td>{{ $qurbanJamaah->status_pembayaran }}</td>
            </tr>
        </table>
        
        <p>Terima kasih atas partisipasi Anda dalam program Qurban Jamaah kami.</p>
    </div>
</body>
</html>