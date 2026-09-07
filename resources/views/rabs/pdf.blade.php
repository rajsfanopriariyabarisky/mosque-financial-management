<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rancangan Anggaran Biaya Masjid Nurul Ishalh</title>
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
            max-width: 900px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .text-end {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table style="border: none; width: 100%;">
                <tr>
                    <td width="15%" style="border: none;">
                        <img src="{{ public_path('images/logo-masjid.png') }}" alt="Logo" class="logo">
                    </td>
                    <td width="85%" style="border: none; text-align: center;">
                        <h1 class="title">Masjid Nurul Ishlah</h1>
                        <p class="subtitle">Jl. Kramat Raya No.98, Jakarta Pusat, Indonesia (Universitas BSI)</p>
                        <p class="subtitle">Telp: +62 812-3456-7890 | Email: info@nurulishlah.or.id</p>
                    </td>
                </tr>
            </table>
        </div>

        <h2 class="text-center">Rancangan Anggaran Biaya</h2>

        <table>
            <thead>
                <tr>
                    <th>Nama Program</th>
                    <th>Periode</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
                    <th class="text-center">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rabs as $rab)
                    <tr>
                        <td>{{ $rab->nama }}</td>
                        <td>{{ $rab->periode }}</td>
                        <td>{{ $rab->kategori }}</td>
                        <td>{{ $rab->jenis }}</td>
                        <td>{!! $rab->keterangan !!}</td>
                        <td class="text-end">{{ format_rupiah($rab->jumlah) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table style="width: 100%; border: none; margin-top: 30px;">
            <tr>
                <td style="width: 50%; border: none; text-align: center;">
                    <p>Bendahara</p>
                    <br><br><br>
                    <p>(_______________)</p>
                </td>
                <td style="width: 50%; border: none; text-align: center;">
                    <p>Ketua</p>
                    <br><br><br>
                    <p>(_______________)</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
