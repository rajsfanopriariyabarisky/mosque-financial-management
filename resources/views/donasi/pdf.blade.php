<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Donasi #{{ $donasi->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
            font-size: 14px;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
        }
        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
            text-align: center;
        }
        .logo {
            width: 60px;
            height: auto;
            display: inline-block;
            vertical-align: middle;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
        }
        .subtitle {
            font-size: 12px;
            margin: 2px 0;
        }
        .content {
            margin-bottom: 20px;
            text-align: center;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 10px;
        }
        .info {
            margin-bottom: 5px;
            text-align: left;
        }
        h2 {
            font-size: 16px;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            vertical-align: top;
            padding: 5px;
            text-align: center;
        }
        .noborder {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table class="noborder">
                <tr>
                    <td width="15%" class="noborder">
                        <img src="{{ public_path('images/logo-masjid.png') }}" alt="Logo" class="logo">
                    </td>
                    <td width="85%" class="noborder text-center">
                        <h1 class="title">Masjid Nurul Ishlah</h1>
                        <p class="subtitle">Jl. Kramat Raya No.98, Jakarta Pusat, Indonesia (Universitas BSI)</p>
                        <p class="subtitle">Telp: +62 812-3456-7890 | Email: info@nurulishlah.or.id</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="content">
            <h2>KWITANSI DONASI #{{ $donasi->id }}</h2>
            <table class="noborder">
                <tr>
                    <td class="info"><strong>Tanggal:</strong></td>
                    <td class="info">{{ $donasi->tanggal }}</td>
                </tr>
                <tr>
                    <td class="info"><strong>ID Pembayaran:</strong></td>
                    <td class="info">{{ $donasi->order_id }}</td>
                </tr>
                <tr>
                    <td class="info"><strong>Nama Donatur:</strong></td>
                    <td class="info">{{ $donasi->nama_donatur }}</td>
                </tr>
                <tr>
                    <td class="info"><strong>Email:</strong></td>
                    <td class="info">{{ $donasi->email }}</td>
                </tr>
                <tr>
                    <td class="info"><strong>Jumlah Donasi:</strong></td>
                    <td class="info">{{ format_rupiah($donasi->jumlah) }}</td>
                </tr>
                <tr>
                    <td class="info"><strong>Status Pembayaran:</strong></td>
                    <td class="info">{{ ucfirst($donasi->status_pembayaran) }}</td>
                </tr>
                <tr>
                    <td class="info"><strong>Keterangan:</strong></td>
                    <td class="info">{{ $donasi->keterangan ?? 'Donasi Donatur Tetap' }}</td>
                </tr>
            </table>
        </div>

        <table>
            <tr class="noborder">
                <td class="noborder" width="50%">
                    <p>Bendahara</p>
                    <br><br><br>
                    <p>(_______________)</p>
                </td>
                <td class="noborder" width="50%">
                    <p>Ketua</p>
                    <br><br><br>
                    <p>(_______________)</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
