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

<div class="panel panel-profile">
  <div class="clearfix">
    <form action="{{route('user.update', $data_user->id)}}" method="POST" enctype="multipart/form-data">
      {{csrf_field()}}
      {{ method_field('PUT') }}
      <!-- LEFT COLUMN -->
      <div class="profile-left">
        <!-- PROFILE HEADER -->
        <div class="profile-header">
          <div class="overlay"></div>
          <div class="profile-main">
            {{-- @if(Auth::user()->anggota->avatar == ''&& Auth::user()->anggota->jenis_kelamin == 'L')
            <img src="{{asset('images/default.png')}}" width="150x" height="150x" class="img-circle" alt="Avatar">
            @elseif(Auth::user()->anggota->avatar == ''&& Auth::user()->anggota->jenis_kelamin == 'P')
            <img src="{{asset('images/default1.png')}}" width="150x" height="150x" class="img-circle" alt="Avatar">
            @else
            <img src="{{asset('images/' .Auth::user()->anggota->avatar)}}" width="150x" height="150x" class="img-circle"
              alt="Avatar">
            @endif --}}
            @if (Auth::user()->role == 'ptgs')
            <img src="{{Auth::user()->getAvaptgs()}}" width="150x" height="150x" class="img-circle" alt="Avatar">
            @elseif(Auth::user()->role == 'user')
            <img src="{{Auth::user()->getAvauser()}}" width="150x" height="150x" class="img-circle" alt="Avatar">

            @else
            <img src="{{asset('images/admin.png')}}" width="150x" height="150x" class="img-circle" alt="Avatar">
            @endif

            @if (Auth::user()->role == 'admin')
            <h3 class="name">{{Auth::user()->name}}</h3>

            @elseif(Auth::user()->role == 'ptgs')
            <h3 class="name">{{Auth::user()->pegawai->nama}}</h3>
            @else
            <h3 class="name">{{Auth::user()->anggota->nama}}</h3>

            @endif
            <span class="online-status status-available">Available</span>
          </div>
          {{-- <div class="profile-stat">
            <div class="row">
              <div class="col-md-4 stat-item">
                45 <span>Projects</span>
              </div>
              <div class="col-md-4 stat-item">
                15 <span>Awards</span>
              </div>
              <div class="col-md-4 stat-item">
                2174 <span>Points</span>
              </div>
            </div>
          </div> --}}
        </div>
        <!-- END PROFILE HEADER -->
        <!-- PROFILE DETAIL -->
        <div class="profile-detail">
          @if (Auth::user()->allowsConfuse())

          <div class="profile-info">
            <div class="text-center">
              <label for="avatar">Avatar</label>
              <input type="file" name="avatar" id="avatar" class="form-control">

            </div>
            @endif

          </div>
        </div>
        <!-- END PROFILE DETAIL -->
      </div>
      <!-- END LEFT COLUMN -->
      <!-- RIGHT COLUMN -->
      <div class="profile-right">
        <!-- AWARDS -->
        <div class="card">
          <h4 class="heading">Profil Detail</h4>

          @if (Auth::user()->role == 'admin')
          <div class="form-group">
            <label for="nama">Nama Admin</label>
            <input id="nama" name="nama" type="text" class="form-control" value="{{$data_user->name}}" readonly>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="text" class="form-control" readonly value="{{$data_user->email}}">
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
          @elseif(Auth::user()->role == 'ptgs')
          <div class="form-group">
            <label for="id_pegawai">ID Pegawai</label>
            <input id="id_pegawai" name="id_pegawai" type="text" class="form-control"
              value="{{$data_user->pegawai->id_pegawai}}" readonly>
          </div>
          <div class="form-group">
            <label for="nama">Nama Pegawai</label>
            <input id="nama" name="nama" type="text" class="form-control" value="{{$data_user->name}}" readonly>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="text" class="form-control" readonly value="{{$data_user->email}}">
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin">
              <option value="L" {{$data_user->pegawai->jenis_kelamin === "L" ? "selected" : ""}}>Laki-Laki
              </option>
              <option value="P" {{$data_user->pegawai->jenis_kelamin === "P" ? "selected" : ""}}>Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input id="tempat_lahir" name="tempat_lahir" type="text" readonly class="form-control"
              value="{{$data_user->pegawai->tempat_lahir}}">
          </div>
          <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input id="tgl_lahir" name="tgl_lahir" type="date" readonly class="form-control"
              value="{{$data_user->pegawai->tgl_lahir}}">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" type="text" class="form-control"
              rows="3">{{$data_user->pegawai->alamat}}</textarea>
          </div>
          <div class="form-group">
            <label for="no_hp">No. HP</label>
            <input id="no_hp" name="no_hp" type="number" class="form-control" value="{{$data_user->pegawai->no_hp}}">
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
          @else
          <div class="form-group">
            <label for="id_anggota">ID Anggota</label>
            <input id="id_anggota" name="id_anggota" type="text" class="form-control"
              value="{{$data_user->anggota->id_anggota}}" readonly>
          </div>
          <div class="form-group">
            <label for="nama">Nama Anggota</label>
            <input id="nama" name="nama" type="text" class="form-control" value="{{$data_user->name}}" readonly>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="text" class="form-control" readonly value="{{$data_user->email}}">
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin">
              <option value="L" {{$data_user->anggota->jenis_kelamin === "L" ? "selected" : ""}}>Laki-Laki
              </option>
              <option value="P" {{$data_user->anggota->jenis_kelamin === "P" ? "selected" : ""}}>Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input id="tempat_lahir" name="tempat_lahir" type="text" readonly class="form-control"
              value="{{$data_user->anggota->tempat_lahir}}">
          </div>
          <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input id="tgl_lahir" name="tgl_lahir" type="date" readonly class="form-control"
              value="{{$data_user->anggota->tgl_lahir}}">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" type="text" class="form-control"
              rows="3">{{$data_user->anggota->alamat}}</textarea>
          </div>
          <div class="form-group">
            <label for="no_hp">No. HP</label>
            <input id="no_hp" name="no_hp" type="number" class="form-control" value="{{$data_user->anggota->no_hp}}">
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
          @endif

          <div class="text-right">
            <button id="submit" type="submit" class="btn btn-primary">Update</button>
          </div>

        </div>
        <!-- END AWARDS -->
        <!-- TABBED CONTENT -->

        <!-- END TABBED CONTENT -->
      </div>
      <!-- END RIGHT COLUMN -->
    </form>
  </div>
</div>


@endsection
