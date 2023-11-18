@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Tambah data siswa</h3>
                </div>
            </div>
        </div>

        <section id="basic-vertical-layouts">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="/dashboard/siswa" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama">Nisn</label>
                                                <input type="text" id="nama"
                                                    class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}" name="nisn"
                                                    placeholder="Nisn">
                                                @error('nisn')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama">Nis</label>
                                                <input type="text" id="nama"
                                                    class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis') }}" name="nis"
                                                    placeholder="Nis">
                                                @error('nis')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="username">Nama</label>
                                                <input type="text" id="nama"
                                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" name="nama"
                                                    placeholder="Nama">
                                                @error('nama')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="id_kelas">Kelas</label>
                                                <select class="form-select @error('id_kelas') is-invalid @enderror" value="{{ old('id_kelas') }}"  name="id_kelas">
                                                    @foreach ($kelases as $kelas)
                                                      @if(old('id_kelas') == $kelas->id)
                                                        <option value="{{ $kelas->id }}" selected>{{ $kelas->nama_kelas }}</option>
                                                      @else
                                                         <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                                      @endif
                                                    @endforeach
                                                  </select>
                                                @error('id_kelas')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" id="alamat"
                                                    class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" name="alamat"
                                                    placeholder="Alamat">
                                                @error('alamat')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="no_telp">No Telp</label>
                                                <input type="text" id="no_telp"
                                                    class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" name="no_telp"
                                                    placeholder="No telp">
                                                @error('no_telp')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" id="password"
                                                    class="form-control @error('password')  is-invalid @enderror" name="password"
                                                    placeholder="Password">
                                                @error('password')
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