@extends('layouts.master')
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-body">
        <div class="col-md-6">
          <div class="panel-heading">
            <h4 class="panel-title">Laporan Data Buku Export PDF</h4>
          </div>
          <div class="form-group">
            <label for="semua">Export Semua Data Buku </label>
            <br>
            <a href="/laporan/exportPdf" class="btn btn-danger">export PDF</a>
          </div>
          <div class="form-group">
            <label for="kategori">Export Berdasarkan Kategori Buku</label>
            <br>
            <div class="dropdown">
              <a href="#" class="dropdown-toggle btn btn-danger" data-toggle="dropdown" aria-expanded="false">
                Pilih Kategori <i class="icon-submenu lnr lnr-chevron-down"></i></a>
              <ul class="dropdown-menu">
                @foreach ($kategoris as $data)
                <li value="{{$data->id}}">
                  <a href="/laporan/exportPdfKateg/{{$data->id}}"><span>{{$data->kategori}}</span></a>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="form-group">
            <label for="kategori">Export Berdasarkan Lokasi Buku</label>
            <br>
            <div class="dropdown">
              <a href="#" class="dropdown-toggle btn btn-danger" data-toggle="dropdown" aria-expanded="false">
                Pilih Lokasi <i class="icon-submenu lnr lnr-chevron-down"></i></a>
              <ul class="dropdown-menu">
                @foreach ($raks as $data)
                <li value="{{$data->id}}">
                  <a href="/laporan/exportPdfRak/{{$data->id}}"><span>{{$data->rak}}</span></a>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="panel-heading">
            <h4 class="panel-title">Laporan Data Buku Export Excel</h4>
          </div>
          <div class="form-group">
            <label for="semua">Export Semua Data Buku </label>
            <br>
            <a href="/laporan/exportExcel" class="btn btn-success">export Excel</a>
          </div>
          <div class="form-group">
            <label for="kategori">Export Berdasarkan Kategori Buku</label>
            <br>
            <div class="dropdown">
              <a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" aria-expanded="false">
                Pilih Kategori <i class="icon-submenu lnr lnr-chevron-down"></i></a>
              <ul class="dropdown-menu">
                @foreach ($kategoris as $data)
                <li value="{{$data->id}}">
                  <a href="/laporan/exportExcelKateg?kateg_id={{$data->id}}"><span>{{$data->kategori}}</span></a>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="form-group">
            <label for="kategori">Export Berdasarkan Lokasi Buku</label>
            <br>
            <div class="dropdown">
              <a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" aria-expanded="false">
                Pilih Lokasi <i class="icon-submenu lnr lnr-chevron-down"></i></a>
              <ul class="dropdown-menu">
                @foreach ($raks as $data)
                <li value="{{$data->id}}">
                  <a href="/laporan/exportExcelRak?rak_id={{$data->id}}"><span>{{$data->rak}}</span></a>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="panel-body">
        <div class="col-md-6">
          <div class="panel-heading">
            <h4 class="panel-title">Laporan Data Transaksi Export PDF</h4>
          </div>
          <div class="form-group">
            <label for="semua">Export Semua Data Transaksi </label>
            <br>
            <a href="/laporan/trsPdf" class="btn btn-danger">export PDF</a>
          </div>
          <div class="form-group">
            <label for="kategori">Export Berdasarkan Status Transaksi</label>
            <br>
            <div class="dropdown">
              <a href="#" class="dropdown-toggle btn btn-danger" data-toggle="dropdown" aria-expanded="false">
                Pilih Status <i class="icon-submenu lnr lnr-chevron-down"></i></a>
              <ul class="dropdown-menu">
                <li>
                  <a href="{{url('laporan/trsPdf?status=book')}}"><span> Book </span></a>
                  <a href="{{url('laporan/trsPdf?status=pinjam')}}"><span> Pinjam </span></a>
                  <a href="{{url('laporan/trsPdf?status=kembali')}}"><span> Kembali </span></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="form-group">
            <label for="kategori">Export Berdasarkan Tanggal Transaksi</label>
            <br>
            <div class="dropdown">
              <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Pilih Tanggal </a>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="panel-heading">
            <h4 class="panel-title">Laporan Data Transaksi Export Excel</h4>
          </div>
          <div class="form-group">
            <label for="semua">Export Semua Data Transaksi </label>
            <br>
            <a href="/laporan/trsExcel" class="btn btn-success">export Excel</a>
          </div>
          <div class="form-group">
            <label for="kategori">Export Berdasarkan Status Transaksi</label>
            <br>
            <div class="dropdown">
              <a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" aria-expanded="false">
                Pilih Status <i class="icon-submenu lnr lnr-chevron-down"></i></a>
              <ul class="dropdown-menu">
                <li>
                  <a href="{{url('laporan/trsExcel?status=book')}}"><span> Book </span></a>
                  <a href="{{url('laporan/trsExcel?status=pinjam')}}"><span> Pinjam </span></a>
                  <a href="{{url('laporan/trsExcel?status=kembali')}}"><span> Kembali </span></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="form-group">
            <label for="kategori">Export Berdasarkan Tanggal Transaksi</label>
            <br>
            <div class="dropdown">
              <a href="#" class="btn btn-success" data-toggle="modal" data-target="#excelModal">Pilih Tanggal </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

{{-- modal --}}
<div class=" modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title " id="exampleModalLabel">Pilih Tanggal</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="/laporan/trsPdfTgl" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label for="from">Dari Tanggal</label>
            <input id="from" name="from" type="date" class="form-control" required>
          </div>
          <div class=" form-group">
            <label for="to">Sampai Tanggal</label>
            <input id="to" name="to" type="date" class="form-control" required>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- modal excel--}}
<div class=" modal fade" id="excelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title " id="exampleModalLabel">Pilih Tanggal</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="/laporan/trsExcelTgl" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label for="from">Dari Tanggal</label>
            <input id="from" name="from" type="date" class="form-control" required>
          </div>
          <div class=" form-group">
            <label for="to">Sampai Tanggal</label>
            <input id="to" name="to" type="date" class="form-control" required>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
