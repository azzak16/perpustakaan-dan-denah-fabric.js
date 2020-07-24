{{-- @section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
@stop
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script type="text/javascript">
  var ctx = document.getElementById('myChart');

  Chart.defaults.global.defaultFontFamily = 'Lato';

  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
    datasets: {!! json_encode($datasets) !!}
    },
    options: {
      title: {
        display : true,
        text : 'Kategori Buku Terlaris',
        fontSize : 24
      },
      legend: {
        position : 'right',
      },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endpush --}}
@extends('layouts.master')
@section('content')

<div class="panel panel-headline">
  <div class="panel-heading">
    <h3 class="panel-title">Dashboard Overview</h3>
    <p class="panel-subtitle">{{ date('Y-M-d', strtotime(Carbon\Carbon::today()->toDateString())) }}</p>
  </div>
  @if(Auth::user()->allowsConfig())
  <div class="panel-body">
    <div class="row">
      <div class="col-md-3">
        <div class="metric">
          <span class="icon"><i class="fa fa-book"></i></span>
          <p>
            <span class="number">{{$bukus->sum('jumlah')}}</span>
            <span class="title">Buku</span>
          </p>
          <a class="btn btn-info btn-sm pull-right" data-toggle="collapse" href="#collapseBuku" role="button"
            aria-expanded="false" aria-controls="collapseExample">Detail</a>
        </div>
        <div class="collapse" id="collapseBuku">
          <div class="card card-body">
            <div class="metric">
              <span class="icon"><i class="fa fa-fonticons"></i></span>
              <p>
                <span class=" number">{{$kategoris->count()}}</span>
                <span class="title">Kategori</span>
              </p>
            </div>
            <div class="metric">
              <span class="icon"><i class="fa fa-file-text"></i></span>
              <p>
                <span class=" number">{{$bukus->count()}}</span>
                <span class="title">Judul</span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="metric">
          <span class="icon"><i class="fa fa-user"></i></span>
          <p>
            <span class="number">{{$pegawais->count()}}</span>
            <span class="title">PEGAWAI</span>
          </p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="metric">
          <span class="icon"><i class="fa fa-users"></i></span>
          <p>
            <span class="number">{{$anggotas->count()}}</span>
            <span class="title">ANGGOTA</span>
          </p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="metric">
          <span class="icon"><i class="fa fa-shopping-cart"></i></span>
          <p>
            <span class=" number">{{$transaksis->count()}}</span>
            <span class="title">Transaksi</span>
          </p>
          <a class="btn btn-info btn-sm pull-right" data-toggle="collapse" href="#collapseTrs" role="button"
            aria-expanded="false" aria-controls="collapseExample">Detail</a>
        </div>
        <div class="collapse" id="collapseTrs">
          <div class="card card-body">
            <div class="metric">
              <span class="icon"><i class="fa fa-handshake-o"></i></span>
              <p>
                <span class=" number">{{$transaksis->where('status', 'book')->count()}}</span>
                <span class="title">Booking</span>
              </p>
            </div>
            <div class="metric">
              <span class="icon"><i class="fa fa-spinner"></i></span>
              <p>
                <span class=" number">{{$transaksis->where('status', 'pinjam')->count()}}</span>
                <span class="title">Pinjam</span>
              </p>
            </div>
            <div class="metric">
              <span class="icon"><i class="fa fa-check"></i></span>
              <p>
                <span class=" number">{{$transaksis->where('status', 'kembali')->count()}}</span>
                <span class="title">Kembali</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>
  @endif
</div>

@endsection
