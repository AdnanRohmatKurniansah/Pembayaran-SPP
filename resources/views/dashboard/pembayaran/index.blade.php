@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Data pembayaran</h3>
                </div>
                
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary mb-3" href="/dashboard/pembayaran/create">Tambah data</a>
                        </div>
                        @if (Auth::guard('petugas')->user()->level == 'admin')
                            <div class="col text-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Generate Laporan
                                </button>
                            </div>
                        @endif
                    </div>
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
                                <th>Action</th>
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
                                    @php
                                        $tagihan = \App\Models\Tagihan::where('id', $pembayaran->id_tagihan)->first()
                                    @endphp
                                    <td>
                                        @if ($tagihan->status == 'belum_lunas')
                                            <a class="badge-primary" href="/dashboard/pembayaran/{{ $pembayaran->id }}/edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Generate laporan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/dashboard/pembayaran/laporan" method="post">
                @csrf
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label class="form-label text-dark" for="dari">Dari: </label>
                            <input class="form-control" required name="dari" id="dari" type="date"
                                placeholder="Dari">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label text-dark" for="sampai">Sampai: </label>
                            <input class="form-control" required name="sampai" id="sampai" type="date"
                                placeholder="Sampai">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
          </div>
        </div>
    </div>


@endsection