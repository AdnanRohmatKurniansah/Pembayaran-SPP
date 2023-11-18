@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Edit data kelas</h3>
                </div>
            </div>
        </div>

        <section id="basic-vertical-layouts">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="/dashboard/siswa/kelas/{{ $kelas->id }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama">Nama kelas</label>
                                                <input type="text" id="nama"
                                                    class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" name="nama_kelas"
                                                    placeholder="Nama kelas">
                                                @error('nama_kelas')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="kompetensi_keahlian">Kompentensi keahlian</label>
                                                <input type="text" id="kompetensi_keahlian"
                                                    class="form-control @error('kompetensi_keahlian') is-invalid @enderror" value="{{ old('kompetensi_keahlian', $kelas->kompetensi_keahlian) }}" name="kompetensi_keahlian"
                                                    placeholder="Kompetensi keahlian">
                                                @error('kompetensi_keahlian')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"class="btn btn-primary me-1 mb-1">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection