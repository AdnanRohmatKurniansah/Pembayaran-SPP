@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 order-md-1 order-last">
                    <h3>Tambah data spp</h3>
                </div>
            </div>
        </div>

        <section id="basic-vertical-layouts">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="/dashboard/spp" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama">Tahun</label>
                                                <input type="number" min="1" id="nama"
                                                    class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun') }}" name="tahun"
                                                    placeholder="Tahun">
                                                @error('tahun')
                                                    <div class="invalid-feedback justify-content-start text-left">
                                                        {{ $message }}
                                                    </div>            
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama">Nominal</label>
                                                <input type="number" min="1" id="nama"
                                                    class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal') }}" name="nominal"
                                                    placeholder="Nominal">
                                                @error('nominal')
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