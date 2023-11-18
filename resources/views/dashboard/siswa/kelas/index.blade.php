@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Data kelas</h3>
                </div>
                
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary mb-3" href="/dashboard/siswa/kelas/create">Tambah kelas</a>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Kompetensi keahlian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelases as $kelas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kelas->nama_kelas }}</td>
                                    <td>{{ $kelas->kompetensi_keahlian }}</td>
                                    <td>
                                        <form action="/dashboard/siswa/kelas/{{ $kelas->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <a class="badge-primary" href="/dashboard/siswa/kelas/{{ $kelas->id }}/edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button class="badge-circle text-danger badge-circle-light-secondary border-0 bg-transparent" onclick="return confirm('Hapus kelas ini?')" type="submit">
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
@endsection