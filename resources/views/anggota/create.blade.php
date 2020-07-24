@push('script')
<script type="text/javascript">
  var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('submit').disabled = false;
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('submit').disabled = true;
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}
</script>
@endpush

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
        <form action="{{route('anggota.store')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label for="id_anggota">Kode anggota</label>
            <input id="id_anggota" name="id_anggota" type="text" class="form-control" value="{{ $kode }}" readonly=""
              required>
          </div>
          <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
            <label for="nama">Nama</label>
            <input id="nama" name="nama" type="text" class="form-control" value="{{ old('nama') }}"
              placeholder="Masukkan Nama Lengkap" required>
            @if ($errors->has('nama'))
            <span class="help-block">
              <strong>{{ $errors->first('nama') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}"
              placeholder="Masukkan Email Anda" required>
            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" onkeyup='check();' name="password"
              placeholder="Masukkan Password" required>
            @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input id="confirm_password" type="password" onkeyup="check()" class="form-control"
              name="password_confirmation" placeholder="Konfirmasi Password" required>
            <span id='message'></span>
          </div>
          <div class="form-group {{ $errors->has('agama') ? ' has-error' : '' }}">
            <label for="agama">Agama</label>
            <input id="agama" name="agama" type="text" class="form-control" value="{{ old('agama') }}"
              placeholder="Masukkan Agama" required>
            @if ($errors->has('agama'))
            <span class="help-block">
              <strong>{{ $errors->first('agama') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin" required="">
              <option value="L">Laki-Laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <div class="form-group {{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input id="tempat_lahir" name="tempat_lahir" type="text" value="{{ old('tempat_lahir') }}"
              class="form-control" placeholder="Masukkan Kota Kelahiran" required>
            @if ($errors->has('tempat_lahir'))
            <span class="help-block">
              <strong>{{ $errors->first('tempat_lahir') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('tgl_lahir') ? ' has-error' : '' }}">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input id="tgl_lahir" name="tgl_lahir" type="date" value="{{ old('tgl_lahir') }}" class="form-control"
              required>
            @if ($errors->has('tgl_lahir'))
            <span class="help-block">
              <strong>{{ $errors->first('tgl_lahir') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" type="text" class="form-control" rows="3"
              placeholder="Masukkan Alamat Sekarang" required>{{ old('alamat') }}</textarea>
            @if ($errors->has('alamat'))
            <span class="help-block">
              <strong>{{ $errors->first('alamat') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('no_hp') ? ' has-error' : '' }}">
            <label for="no_hp">No. HP</label>
            <input id="no_hp" name="no_hp" type="number" class="form-control" value="{{ old('no_hp') }}"
              placeholder="Masukkan No. Hp" required>
            @if ($errors->has('no_hp'))
            <span class="help-block">
              <strong>{{ $errors->first('no_hp') }}</strong>
            </span>
            @endif
          </div>

          <div class="modal-footer">
            <button type="submit" id="submit" class="btn btn-primary">Register</button>
            <a href="{{route('anggota.index')}}" type="button" class="btn btn-warning">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
