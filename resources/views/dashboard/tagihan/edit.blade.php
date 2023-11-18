@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Edit data tagihan</h3>
                </div>
            </div>
        </div>

        <section id="basic-vertical-layouts">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="/dashboard/tagihan/{{ $tagihan->id }}" method="POST">
                                @method('put')
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="id_siswa">Siswa</label>
                                                <select class="form-select @error('id_siswa') is-invalid @enderror"  name="id_siswa">
                                                    @foreach ($siswas as $siswa)
                                                        @if(old('id_siswa', $tagihan->id_siswa) == $siswa->id)
                                                            <option value="{{ $siswa->id }}" selected>{{ $siswa->nis }} - {{ $siswa->nama }} - {{ $siswa->kelas->nama_kelas }}</option>
                                                        @else
                                                            <option value="{{ $siswa->id }}">{{ $siswa->nis }} - {{ $siswa->nama }} - {{ $siswa->kelas->nama_kelas }}</option>
                                                        @endif
                                                    @endforeach
                                                  </select>
                                                @error('id_siswa')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="id_spp">Spp</label>
                                                <select class="form-select @error('id_spp') is-invalid @enderror"  name="id_spp">
                                                    @foreach ($spps as $spp)
                                                        @if(old('id_spp', $tagihan->id_spp) == $spp->id)
                                                            <option value="{{ $spp->id }}" selected>Rp. {{ number_format($spp->nominal, 0, ',', '.') }} - {{ $spp->tahun }}</option>
                                                        @else
                                                            <option value="{{ $spp->id }}">Rp. {{ number_format($spp->nominal, 0, ',', '.') }} - {{ $spp->tahun }}</option>
                                                        @endif
                                                    @endforeach
                                                  </select>
                                                @error('id_spp')
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