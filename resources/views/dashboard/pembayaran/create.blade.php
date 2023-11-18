@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Tambah data pembayaran</h3>
                </div>
            </div>
        </div>

        <section id="basic-vertical-layouts">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="/dashboard/pembayaran" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="id_tagihan">List Tagihan</label>
                                                <select class="form-select @error('id_tagihan') is-invalid @enderror" value="{{ old('id_tagihan') }}"  name="id_tagihan">
                                                    @foreach ($tagihans as $tagihan)
                                                      @if(old('id_tagihan') == $tagihan->id)
                                                        <option value="{{ $tagihan->id }}" selected>{{ $tagihan->siswa->nisn }} - {{ $tagihan->siswa->nama }} - {{ $tagihan->spp->tahun }}</option>
                                                      @else
                                                         <option value="{{ $tagihan->id }}">{{ $tagihan->siswa->nisn }} - {{ $tagihan->siswa->nama }} - {{ $tagihan->spp->tahun }}</option>
                                                      @endif
                                                    @endforeach
                                                  </select>
                                                @error('id_tagihan')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="jumlah_bayar">Jumlah bayar</label>
                                                <input type="number" id="jumlah_bayar"
                                                    class="form-control @error('jumlah_bayar') is-invalid @enderror" value="{{ old('jumlah_bayar') }}" name="jumlah_bayar"
                                                    placeholder="Jumlah bayar">
                                                @error('jumlah_bayar')
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