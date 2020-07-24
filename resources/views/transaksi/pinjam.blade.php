@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-10">Pinjam</h3>
<div class=" row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Pinjam Transaksi</h3>
        <div class="panel-body">
          <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode Transaksi</th>
                <th>Judul Buku</th>
                <th>Nama Peminjan</th>
                <th>Pegawai Bertugas</th>
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
                <td>{{$data->anggota->nama}}</td>
                <td>{{$data->pegawai->nama}}</td>
                <td>{{date('d/m/y', strtotime($data->tgl_pinjam))}}</td>
                <td>{{date('d/m/y', strtotime($data->kembali_bnr))}}</td>
                <td><span class="label label-primary">{{$data->status}}</span></td>
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
