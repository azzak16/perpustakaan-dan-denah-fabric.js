@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-10">Buku</h3>
@if(Auth::user()->allowsConfig())
<a href="{{route('buku.create')}}" class="btn btn-primary col-md-2 fa fa-plus-square"> Tambah buku</a>
@endif
<div class=" row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Data buku</h3>
        <div class="panel-body">
          <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode buku</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Kategori</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_buku as $data)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->kode_buku}}</td>
                <td>
                  <a href="{{route('buku.show', $data->id)}}">
                    <img src="{{($data->getCover())}}" class="img-circle" alt="Avatar" height="40x" width="40x" />
                    {{$data->judul_buku}}
                  </a>
                </td>
                <td>{{$data->penulis}}</td>
                <td>{{$data->penerbit}}</td>
                <td>{{$data->kategori->kategori}}</td>
                <td>{{$data->jumlah}}</td>
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
