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
          <img src="{{($data_pegawai->getAvatar())}}" class="img-circle" alt="Avatar" width="150x" height="150x" />
          <h3 class="name">{{$data_pegawai->nama}}</h3>
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
        <h4 class="heading">Detail Pegawai</h4>
        <ul class="list-group list-group-flush">
          <li class="list-group-item list-group-item-info">Kode Pegawai
            <span class="right">{{$data_pegawai->id_pegawai}}</span>
          </li>
          <li class="list-group-item">Nama
            <span class="right">{{$data_pegawai->nama}}</span>
          </li>
          <li class="list-group-item list-group-item-info">Agama
            <span class="right">{{$data_pegawai->agama}}</span>
          </li>
          <li class="list-group-item">Gender
            <span class="right">{{$data_pegawai->jenis_kelamin}}</span>
          </li>
          <li class="list-group-item list-group-item-info">Tempat Lahir
            <span class="right">{{$data_pegawai->tempat_lahir}}</span>
          </li>
          <li class="list-group-item">Tanggal Lahir
            <span class="right">{{$data_pegawai->tgl_lahir}}</span>
          </li>
          <li class="list-group-item list-group-item-info">Alamat
            <span class="right">{{$data_pegawai->alamat}}</span>
          </li>
          <li class="list-group-item">No. HP
            <span class="right">{{$data_pegawai->no_hp}}</span>
          </li>
        </ul>
        <div class="text-right">
          <form action="{{ route('pegawai.destroy', $data_pegawai->id) }}" method="post">
            <a href="{{route('pegawai.edit', $data_pegawai->id)}}" class="btn btn-primary">Edit</a>
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
