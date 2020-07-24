@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-10">Kembali</h3>
<div class=" row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Kembali Transaksi</h3>
        <div class="panel-body">
          <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode Transaksi</th>
                <th>Judul Buku</th>
                <th>Nama Peminjan</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
                <th>Keterangan</th>
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
                <td>{{date('d/m/y', strtotime($data->tgl_kembali))}}</td>
                <td>{{$data->denda}}</td>
                <td>{{$data->ket}}</td>
                <td><span class="label label-success">{{$data->status}}</span></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
