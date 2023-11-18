@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>History pembayaran anda</h3>
                </div>
                
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama petugas</th>
                                <th>Siswa</th>
                                <th>Tanggal bayar</th>
                                <th>Tahun spp</th>
                                <th>Jumlah bayar</th>
                                <th>Jumlah kurang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayarans as $pembayaran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pembayaran->petugas->nama_petugas }}</td>
                                    <td>
                                        {{ $pembayaran->tagihan->siswa->nisn }} - {{ $pembayaran->tagihan->siswa->nama }}
                                    </td>                                    
                                    <td>{{ $pembayaran->created_at->format('d M Y h:i') }}</td>
                                    <td>
                                        {{ $pembayaran->tagihan->spp->tahun }}
                                    </td>
                                    <td>Rp. {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($pembayaran->jumlah_kurang, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

@endsection