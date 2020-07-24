@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-10">Anggota</h3>
<a href="{{route('anggota.create')}}" class="btn btn-primary col-md-2 fa fa-plus-square"> Tambah anggota</a>
<div class=" row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Data anggota</h3>
        <div class="panel-body">
          <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th>#</th>
                <th>ID anggota</th>
                <th>NAMA</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_anggota as $data)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->id_anggota}}</td>
                <td>
                  <img src="{{($data->getAvatar())}}" class="img-circle" alt="Avatar" height="40x" width="40x" />
                  {{$data->nama}}
                </td>
                <td>
                  <a href="{{route('anggota.show', $data->id)}}" class="label label-info">detail</a>
                </td>
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
