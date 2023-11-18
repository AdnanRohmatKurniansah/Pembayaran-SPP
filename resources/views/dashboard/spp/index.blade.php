@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Data spp</h3>
                </div>
                
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary mb-3" href="/dashboard/spp/create">Tambah data spp</a>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Nominal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spps as $spp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $spp->tahun }}</td>
                                    <td>Rp. {{ number_format($spp->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="/dashboard/spp/{{ $spp->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <a class="badge-primary" href="/dashboard/spp/{{ $spp->id }}/edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button class="badge-circle text-danger badge-circle-light-secondary border-0 bg-transparent" onclick="return confirm('Hapus data spp ini?')" type="submit">
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