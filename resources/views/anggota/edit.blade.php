@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-9">Tambah Data anggota</h3>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Tambah Data</h3>
      </div>
      <div class="panel-body">
        <form action="{{route('anggota.update', $data_anggota->id)}}" method="POST">
          {{csrf_field()}}
          {{ method_field('PUT') }}
          <div class="form-group">
            <label for="id_anggota">Kode anggota</label>
            <input id="id_anggota" name="id_anggota" type="text" class="form-control"
              value="{{$data_anggota->id_anggota}}" readonly="" required>
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input id="nama" name="nama" type="text" class="form-control" value="{{$data_anggota->nama}}">
          </div>
          <div class="form-group">
            <label for="agama">Agama</label>
            <input id="agama" name="agama" type="text" class="form-control" value="{{$data_anggota->agama}}">
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin">
              <option value="L" {{$data_anggota->jenis_kelamin === "L" ? "selected" : ""}}>Laki-Laki</option>
              <option value="P" {{$data_anggota->jenis_kelamin === "P" ? "selected" : ""}}>Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input id="tempat_lahir" name="tempat_lahir" type="text" class="form-control"
              value="{{$data_anggota->tempat_lahir}}">
          </div>
          <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control"
              value="{{$data_anggota->tgl_lahir}}">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" type="text" class="form-control"
              rows="3">{{$data_anggota->alamat}}</textarea>
          </div>
          <div class="form-group">
            <label for="no_hp">No. HP</label>
            <input id="no_hp" name="no_hp" type="number" class="form-control" value="{{$data_anggota->no_hp}}">
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('anggota.show', $data_anggota->id)}}" type="button" class="btn btn-warning">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
