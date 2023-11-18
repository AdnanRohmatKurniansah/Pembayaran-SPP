@extends('layouts.dashboard')

@section('content')
    <div class="page-heading">
        <h3>Statistik pembayaran spp</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldUser"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Siswa</h6>
                                        @php
                                            $siswa = \App\Models\Siswa::count()
                                        @endphp
                                        <h6 class="font-extrabold mb-0">{{ $siswa }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Petugas</h6>
                                        @php
                                            $petugas = \App\Models\Petugas::count()
                                        @endphp
                                        <h6 class="font-extrabold mb-0">{{ $petugas }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldPaper-Fail"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Tagihan</h6>
                                        @php
                                            $tagihan = \App\Models\Tagihan::where('status', 'belum_lunas')->count()
                                        @endphp
                                        <h6 class="font-extrabold mb-0">{{ $tagihan }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pembayaran</h6>
                                        @php
                                            $pembayaran = \App\Models\Pembayaran::count()
                                        @endphp
                                        <h6 class="font-extrabold mb-0">{{ $pembayaran }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Pembayaran bulanan</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<script>
    var pembayarans = {!! json_encode($pembayarans->toArray()) !!};
    console.log(pembayarans);
    var dates = pembayarans.map(pbr => pbr.date); 
    var jumlahBayar = pembayarans.map(pbr => pbr.jumlah_bayar);
    var optionsProfileVisit = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled:false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity:1
        },
        plotOptions: {
            bar: {
                columnWidth: '5%',
            },
        },
        series: [{
            name: 'pembayaran',
            data: jumlahBayar  
        }],
        colors: '#435ebe',
        xaxis: {
            categories: dates,
        },
    }

    var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);

    chartProfileVisit.render();
</script>

@endsection