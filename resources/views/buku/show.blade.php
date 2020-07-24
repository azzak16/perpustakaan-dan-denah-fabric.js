@extends('layouts.master')
@section('content')

<div class="panel panel-profile">
  <div class="clearfix">
    <!-- LEFT COLUMN -->
    <div class="profile-left">
      <!-- PROFILE HEADER -->
      <div class="profile-header">
        <div class="overlay">

          <img src="{{$data_buku->getCover()}}" height="300x" width="360x" alt="Avatar">
          <div class="profile-stat">
            <div class="row">
              <div class="col-md-4 stat-item">
                <span>KATEGORI</span>{{$data_buku->kategori->kategori}}
              </div>
              <div class="col-md-4 stat-item">
                <span>TEMPAT</span>{{$data_buku->rak->rak}}
              </div>
              <div class="col-md-4 stat-item">
                <span>JUMLAH</span>{{$data_buku->jumlah}}
              </div>
            </div>
          </div>
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
        <h4 class="heading">Detail buku</h4>
        <ul class="list-group list-group-flush">
          <li class="list-group-item list-group-item-info">Kode buku
            <span class="right">{{$data_buku->kode_buku}}</span>
          </li>
          <li class=" list-group-item">Judul Buku
            <span class="right">{{$data_buku->judul_buku}}</span>
          </li>
          <li class="list-group-item list-group-item-info">Penulis
            <span class="right">{{$data_buku->penulis}}</span>
          </li>
          <li class="list-group-item">Penerbit
            <span class="right">{{$data_buku->penerbit}}</span>
          </li>
          <li class="list-group-item list-group-item-info">Tahun Terbit
            <span class="right">{{$data_buku->tahun_terbit}}</span>
          </li>
          <br>
          <h4><label class="label label-primary">Deskripsi Buku</label></h4>


          <textarea class="form-control" rows="5" readonly>{{$data_buku->deskripsi}}</textarea>
        </ul>
        @if (Auth::user()->allowsConfig())

        <div class="text-right">
          <form action="{{ route('buku.destroy', $data_buku->id) }}" method="post">
            <a href="{{route('buku.edit', $data_buku->id)}}" class="btn btn-primary">Edit</a>
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <button class="btn btn-danger"
              onclick="return confirm('apa anda yakin ingin menghapus data ini?')">Delete</button>
          </form>
        </div>

        @endif
      </div>
      <!-- END AWARDS -->
      <!-- TABBED CONTENT -->
      <div class="custom-tabs-line tabs-line-bottom left-aligned">
        <ul class="nav" role="tablist">
          <li class="active"></li>
          <li></li>
        </ul>
      </div>

      <!-- END TABBED CONTENT -->
    </div>
    <!-- END RIGHT COLUMN -->
  </div>
</div>


@endsection
