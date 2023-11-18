@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Profile</h3>
                </div>
            </div>
        </div>

        <section id="basic-vertical-layouts">
            <div class="row">
                <div class="card">
                    <div class="card-content">
                        @if (Auth::guard('petugas')->check())  
                            @php
                                $id = Auth::guard('petugas')->user()->id;
                                $petugas = \App\Models\Petugas::where('id', $id)->first();
                            @endphp 
                            <div class="card-body">
                                <div class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" id="nama"
                                                            class="form-control" disabled value="{{ $petugas->nama_petugas }}" name="nama_petugas">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text" id="username"
                                                            class="form-control" disabled value="{{ $petugas->username }}" name="username">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="level">Level</label>
                                                        <select class="form-select" disabled name="level">
                                                            <option value="petugas" {{ old('level', $petugas->level) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                                            <option value="admin" {{ old('level', $petugas->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        </select>                                                
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <form class="form form-vertical" action="/dashboard/ubah_password" method="POST">
                                                    @csrf
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="password">Password lama</label>
                                                                    <input type="password" id="password"
                                                                        class="form-control @error('password_lama')  is-invalid @enderror" name="password_lama"
                                                                        placeholder="Password lama">
                                                                    @error('password_lama')
                                                                        <div class="invalid-feedback justify-content-start text-left">
                                                                            {{ $message }}
                                                                        </div>            
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="password">Password Baru</label>
                                                                    <input type="password" id="password"
                                                                        class="form-control @error('password_baru')  is-invalid @enderror" name="password_baru"
                                                                        placeholder="Password baru">
                                                                    @error('password_baru')
                                                                        <div class="invalid-feedback justify-content-start text-left">
                                                                            {{ $message }}
                                                                        </div>            
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <button type="submit"class="btn btn-primary me-1 mb-1">Ubah</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @php
                                $id = Auth::guard('siswa')->user()->id;
                                $siswa = \App\Models\Siswa::where('id', $id)->first();
                            @endphp
                            <div class="card-body">
                                <div class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="nama">Nisn</label>
                                                        <input type="text" id="nama"
                                                            class="form-control" disabled value="{{ $siswa->nisn }}" name="nisn">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="nama">Nis</label>
                                                        <input type="text" id="nama"
                                                            class="form-control" disabled value="{{ $siswa->nis }}" name="nis">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="username">Nama</label>
                                                        <input type="text" id="nama"
                                                            class="form-control" disabled value="{{ $siswa->nama }}" name="nama">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="id_kelas">Kelas</label>
                                                        <select class="form-select" disabled name="id_kelas">
                                                            @php
                                                                $kelases = \App\Models\Kelas::orderBy('id', 'desc')->get()
                                                            @endphp
                                                            @foreach ($kelases as $kelas)
                                                                @if(old('id_kelas', $siswa->id_kelas) == $kelas->id)
                                                                    <option value="{{ $kelas->id }}" selected>{{ $kelas->nama_kelas }}</option>
                                                                @else
                                                                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <input type="text" id="alamat"
                                                            class="form-control" disabled value="{{ $siswa->alamat }}" name="alamat">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="no_telp">No Telp</label>
                                                        <input type="text" id="no_telp"
                                                            class="form-control" disabled value="{{ $siswa->no_telp }}" name="no_telp"
                                                            placeholder="no_telp">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <form class="form form-vertical" action="/dashboard/ubah_password" method="POST">
                                                    @csrf
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="password">Password lama</label>
                                                                    <input type="password" id="password"
                                                                        class="form-control @error('password_lama')  is-invalid @enderror" name="password_lama"
                                                                        placeholder="Password lama">
                                                                    @error('password_lama')
                                                                        <div class="invalid-feedback justify-content-start text-left">
                                                                            {{ $message }}
                                                                        </div>            
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="password">Password Baru</label>
                                                                    <input type="password" id="password"
                                                                        class="form-control @error('password_baru')  is-invalid @enderror" name="password_baru"
                                                                        placeholder="Password baru">
                                                                    @error('password_baru')
                                                                        <div class="invalid-feedback justify-content-start text-left">
                                                                            {{ $message }}
                                                                        </div>            
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <button type="submit"class="btn btn-primary me-1 mb-1">Ubah</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection