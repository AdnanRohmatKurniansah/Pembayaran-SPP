@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Tagihan anda</h3>
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
                                <th>Siswa</th>
                                <th>Spp</th>
                                <th>Tanggal dibuat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tagihans as $tagihan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tagihan->siswa->nama }}</td>
                                    <td>Rp. {{ number_format($tagihan->spp->nominal, 0, ',', '.') }} - {{ $tagihan->spp->tahun }}</td>
                                    <td>{{ $tagihan->created_at->format('d M Y h:i') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $tagihan->status == 'lunas' ? 'primary' : 'danger' }}">{{ $tagihan->status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection