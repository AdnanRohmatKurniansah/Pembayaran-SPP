<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Pembayaran</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .laporan {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .school-name {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            color: #007BFF;
            margin-bottom: 10px;
        }
        .paper {
            width: 100%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        td {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="laporan">
        <div class="school-name">SMK N 1 Bantul</div>
        <h2>Laporan Pembayaran </h2>
        <div class="paper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Siswa</th>
                        <th>Tanggal Bayar</th>
                        <th>Tahun SPP</th>
                        <th>Jumlah Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $pembayaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pembayaran->petugas->nama_petugas }}</td>
                            <td>
                                {{ $pembayaran->tagihan->siswa->nisn }} - {{ $pembayaran->tagihan->siswa->nama }}
                            </td>                                    
                            <td>{{ $pembayaran->created_at->format('d M Y h:i') }}</td>
                            <td>{{ $pembayaran->tagihan->spp->tahun }}</td>
                            <td>Rp. {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
