@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Data siswa</h3>
                </div>
                
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <a class="btn btn-primary" href="/dashboard/siswa/create">Tambah data</a>
                        </div>
                        <div class="col text-end flex"> 
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Import siswa
                            </button>
                            <a class="btn btn-secondary" href="/dashboard/siswa/export">Export siswa</a>
                        </div>
                    </div>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nisn</th>
                                <th>Nis</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nisn }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->kelas->nama_kelas }}</td>
                                    <td>{{ $siswa->alamat }}</td>
                                    <td>{{ $siswa->no_telp }}</td>
                                    <td>
                                        <form action="/dashboard/siswa/{{ $siswa->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <a class="badge-primary" href="/dashboard/siswa/{{ $siswa->id }}/edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button class="badge-circle text-danger badge-circle-light-secondary border-0 bg-transparent" onclick="return confirm('Hapus siswa ini?')" type="submit">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                          </form>
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih file excel yang mau diimport</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/dashboard/siswa/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label class="form-label text-dark" for="dari">File: </label>
                            <input class="form-control" required name="file" id="dari" type="file"
                                placeholder="File excel">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
          </div>
        </div>
    </div>


@endsection