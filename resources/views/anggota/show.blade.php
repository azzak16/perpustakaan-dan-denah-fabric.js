@extends('layouts.master')
@section('content')

<div class="panel panel-profile">
  <div class="clearfix">
    <!-- LEFT COLUMN -->
    <div class="profile-left">
      <!-- PROFILE HEADER -->
      <div class="profile-header">
        <div class="overlay"></div>
        <div class="profile-main">
          <img src="{{($data_anggota->getAvatar())}}" class="img-circle" alt="Avatar" width="150x" height="150x" />
          <h3 class="name">{{$data_anggota->nama}}</h3>
          <span class="online-status status-available">Available</span>
        </div>
      </div>
      <!-- END PROFILE HEADER -->
      <!-- PROFILE DETAIL -->
      <!-- END PROFILE DETAIL -->
    </div>
    <!-- END LEFT COLUMN -->
    <!-- RIGHT COLUMN -->
    <div class="profile-right">
      <!-- AWARDS -->
      <div class="card">
        <h4 class="heading">Detail anggota</h4>
        <ul class="list-group list-group-flush">
          <li class="list-group-item list-group-item-info">Kode anggota
            <span class="right">{{$data_anggota->id_anggota}}</span>
          </li>
          <li class="list-group-item">Nama
            <span class="right">{{$data_anggota->nama}}</span>
          </li>
          <li class="list-group-item list-group-item-info">Agama
            <span class="right">{{$data_anggota->agama}}</span>
          </li>
          <li class="list-group-item">Gender
            <span class="right">{{$data_anggota->jenis_kelamin}}</span>
          </li>
          <li class="list-group-item list-group-item-info">Tempat Lahir
            <span class="right">{{$data_anggota->tempat_lahir}}</span>
          </li>
          <li class="list-group-item">Tanggal Lahir
            <span class="right">{{$data_anggota->tgl_lahir}}</span>
          </li>
          <li class="list-group-item list-group-item-info">Alamat
            <span class="right">{{$data_anggota->alamat}}</span>
          </li>
          <li class="list-group-item">No. HP
            <span class="right">{{$data_anggota->no_hp}}</span>
          </li>
        </ul>
        <div class="text-right">
          <form action="{{ route('anggota.destroy', $data_anggota->id) }}" method="post">
            <a href="{{route('anggota.edit', $data_anggota->id)}}" class="btn btn-primary">Edit</a>
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <button class="btn btn-danger"
              onclick="return confirm('apa anda yakin ingin menghapus data ini?')">Delete</button>
          </form>
        </div>
      </div>
      <!-- END AWARDS -->
      <!-- TABBED CONTENT -->

      <!-- END TABBED CONTENT -->
    </div>
    <!-- END RIGHT COLUMN -->
  </div>
</div>


@endsection
