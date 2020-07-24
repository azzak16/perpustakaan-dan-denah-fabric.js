@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-10">Transaksi</h3>
<div class=" row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Semua Data Transaksi</h3>
        <div class="panel-body">
          @if (Auth::user()->allowsConfig())
          <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode Transaksi</th>
                <th>Judul Buku</th>
                <th>Nama Peminjan</th>
                {{-- <th>Pegawai Bertugas</th> --}}
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_transaksi as $data)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('transaksi.show', $data->id)}}">{{$data->kode_transaksi}}</a></td>
                <td>{{$data->buku->judul_buku}}</td>
                <td>{{$data->anggota->nama}}</td>
                {{-- <td>{{$data->pegawai->nama}}</td> --}}
                <td>{{$data->tgl_pinjam}}</td>
                <td>{{$data->tgl_kembali}}</td>
                <td>
                  @if($data->status == 'kembali')
                  <p>{{($data->kembali_bnr)}}</p>
                  @else <p class="text-danger">Belum Kembali</p>
                  @endif
                </td>
                <td>
                  @if($data->status == 'book')
                  <span class="label label-warning">Book</span>
                  @elseif($data->status == 'pinjam')
                  <span class="label label-primary">Pinjam</span>
                  @elseif($data->status == 'batal')
                  <span class="label label-danger">Batal</span>
                  @else
                  <label class="label label-success">Kembali</label>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode Transaksi</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_transaksi as $data)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('transaksi.show', $data->id)}}">{{$data->kode_transaksi}}</a></td>
                <td>{{$data->buku->judul_buku}}</td>
                <td>{{$data->tgl_pinjam}}</td>
                <td>{{($data->tgl_kembali)}}</td>
                <td>
                  @if($data->status == 'book')
                  <span class="label label-warning">Book</span>
                  @elseif($data->status == 'pinjam')
                  <span class="label label-primary">Pinjam</span>
                  @elseif($data->status == 'batal')
                  <span class="label label-danger">Batal</span>
                  @else
                  <label class="label label-success">Kembali</label>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
