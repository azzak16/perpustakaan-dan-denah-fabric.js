@push('script')
<script type="text/javascript">
  $(document).on('click', '.pilih', function (e) {
    document.getElementById("judul_buku").value = $(this).attr('data-judul_buku');
    document.getElementById("buku_id").value = $(this).attr('data-buku_id');
    document.getElementById("kategori_id").value = $(this).attr('data-kategori_id');
    $('#myModal').modal('hide');
  });

  $(document).on('click', '.pilih_anggota', function (e) {
    document.getElementById("nama").value = $(this).attr('data-anggota_nama');
    document.getElementById("anggota_id").value = $(this).attr('data-anggota_id');
    $('#myModal2').modal('hide');
  });

  $(document).on('click', '.pilih_pegawai', function (e) {
    document.getElementById("namap").value = $(this).attr('data-pegawai_nama');
    document.getElementById("pegawai_id").value = $(this).attr('data-pegawai_id');
    $('#myModal3').modal('hide');
  });

  $(document).ready( function () {
      $('#table, #table2, #table3').DataTable();
    } );

  $(function () {
      $('#datetimepicker3').datetimepicker({
        format: 'HH:mm'
      });
    });
</script>

@endpush

@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-9">Tambah Transaksi</h3>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Tambah Data</h3>
      </div>
      <div class="panel-body">
        <form action="{{route('transaksi.store')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label for="kode_transaksi">Kode Peminjaman</label>
            <input id="kode_transaksi" name="kode_transaksi" type="text" class="form-control" value="{{ $kode }}"
              readonly="" required>
          </div>
          <input id="denda_id" name="denda_id" type="hidden" class="form-control" value="1" required>

          @if (Auth::user()->allowsConfig())
          <div class="form-group {{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
            <label for="tgl_pinjam">Tanggal Pinjam</label>
            <input id="tgl_pinjam" name="tgl_pinjam" type="date"
              value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" class="form-control"
              readonly required>
            @if ($errors->has('tgl_pinjam'))
            <span class="help-block">
              <strong>{{ $errors->first('tgl_pinjam') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
            <label for="tgl_kembali">Tanggal Kembali</label>
            <input id="tgl_kembali" name="tgl_kembali" type="date"
              value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(7)->toDateString())) }}"
              class="form-control" readonly required>
            @if ($errors->has('tgl_kembali'))
            <span class="help-block">
              <strong>{{ $errors->first('tgl_kembali') }}</strong>
            </span>
            @endif
          </div>

          @else
          <div class="form-group {{ $errors->has('tgl_book') ? ' has-error' : '' }}">
            <label for="tgl_book">Tanggal Booking</label>
            <input id="tgl_bok" name="tgl_book" type="date"
              value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(1)->toDateString())) }}"
              class="form-control" readonly required>
            @if ($errors->has('tgl_book'))
            <span class="help-block">
              <strong>{{ $errors->first('tgl_book') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group" {{ $errors->has('jam_book') ? ' has-error' : '' }}">
            <label for="jam_book">Jam Booking</label>
            <div class='input-group date' id='datetimepicker3'>
              <input type="text" id="jam_bok" name="jam_book" class="form-control" required>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
              </span>
            </div>
            <span>Masukkan jam Antara Pukul 08:00 - 16:00</span>
            @if ($errors->has('jam_book'))
            <span class="help-block">
              <strong>{{ $errors->first('jam_book') }}</strong>
            </span>
            @endif
          </div>
          @endif

          <div class="form-group {{ $errors->has('buku_id') ? ' has-error' : '' }}">
            <label for="buku_id">Judul Buku</label>
            <input id="judul_buku" type="text" class="form-control" readonly="" required>
            <input id="buku_id" name="buku_id" type="hidden" class="form-control" value="{{ old('buku_id') }}" required>
            <input id="kategori_id" name="kategori_id" type="hidden" class="form-control" value="" required>
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-secondary" data-toggle="modal"
                data-target="#myModal"><b>Cari
                  Buku</b> <span class="fa fa-search"></span></button>
            </span>
            @if ($errors->has('buku_id'))
            <span class="help-block">
              <strong>{{ $errors->first('buku_id') }}</strong>
            </span>
            @endif
          </div>

          @if(Auth::user()->allowsConfig())
          <div class="form-group {{ $errors->has('anggota_id') ? ' has-error' : '' }}">
            <label for="anggota_id">Nama Peminjam</label>
            <input id="nama" type="text" class="form-control" readonly="" required>
            <input id="anggota_id" name="anggota_id" type="hidden" class="form-control" value="{{ old('anggota_id') }}"
              required>
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-secondary" data-toggle="modal"
                data-target="#myModal2"><b>Cari
                  Anggota</b> <span class="fa fa-search"></span></button>
            </span>
            @if ($errors->has('anggota_id'))
            <span class="help-block">
              <strong>{{ $errors->first('anggota_id') }}</strong>
            </span>
            @endif
          </div>

          @else
          <div class="form-group {{ $errors->has('anggota_id') ? ' has-error' : '' }}">
            <label for="anggota_id">Nama Peminjam</label>
            <input id="nama" type="text" class="form-control"
              value="{{Auth::user()->anggota->id_anggota}} - {{Auth::user()->anggota->nama}}" readonly="" required>
            <input id="anggota_id" name="anggota_id" type="hidden" class="form-control"
              value="{{ Auth::user()->anggota->id }}" required>

            @if ($errors->has('anggota_id'))
            <span class="help-block">
              <strong>{{ $errors->first('anggota_id') }}</strong>
            </span>
            @endif
          </div>
          @endif

          @if (Auth::user()->role == 'ptgs')

          <div class="form-group {{ $errors->has('pegawai_id') ? ' has-error' : '' }}">
            <label for="pegawai_id">Pegawai</label>
            <input id="nama" type="text" class="form-control"
              value="{{Auth::user()->pegawai->id_pegawai}} - {{Auth::user()->pegawai->nama}}" readonly="" required>
            <input id="pegawai_id" name="pegawai_id" type="hidden" class="form-control"
              value="{{ Auth::user()->pegawai->id }}" required>
            @if ($errors->has('pegawai_id'))
            <span class="help-block">
              <strong>{{ $errors->first('pegawai_id') }}</strong>
            </span>
            @endif
          </div>
          @elseif(Auth::user()->role == 'admin')
          <div class="form-group {{ $errors->has('pegawai_id') ? ' has-error' : '' }}">
            <label for="pegawai_id">Pegawai Bertugas</label>
            <input id="namap" type="text" class="form-control" readonly="" required>
            <input id="pegawai_id" name="pegawai_id" type="hidden" class="form-control" value="{{ old('pegawai_id') }}"
              required>
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-secondary" data-toggle="modal"
                data-target="#myModal3"><b>Cari
                  Pegawai</b> <span class="fa fa-search"></span></button>
            </span>
            @if ($errors->has('pegawai_id'))
            <span class="help-block">
              <strong>{{ $errors->first('pegawai_id') }}</strong>
            </span>
            @endif
          </div>
          @endif

          @if (Auth::user()->allowsConfig())
          <input id="status" name="status" type="hidden" class="form-control" value="pinjam">
          @else
          <input id="status" name="status" type="hidden" class="form-control" value="book">

          @endif

          <div class="modal-footer">
            @if($tes3>0)
            <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
              title="Anda Sudah Mempunyai Transaksi" disabled>Submit</button>
            @else
            <button type="submit" class="btn btn-primary">Submit</button>
            @endif
            <a href="{{route('transaksi.index')}}" type="button" class="btn btn-warning">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal Buku -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="table" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Kode buku</th>
              <th>Judul Buku</th>
              <th>Kategori</th>
              <th>Penulis</th>
              <th>Stok</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data_buku as $data)
            <tr class="pilih" data-buku_id="{{$data->id}}"
              data-judul_buku="{{$data->kode_buku}} - {{$data->judul_buku}}" data-kategori_id="{{$data->kategori_id}}">
              <td>{{$data->kode_buku}}</td>
              <td>{{$data->judul_buku}}</td>
              <td>{{$data->kategori->kategori}}</td>
              <td>{{$data->penulis}}</td>
              <td>{{$data->jumlah}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Anggota-->
<div class=" modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog"
  aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="table2" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>ID Anggota</th>
              <th>Nama Anggota</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data_anggota as $data)
            <tr class="pilih_anggota" data-anggota_id="{{$data->id}}"
              data-anggota_nama="{{$data->id_anggota}} - {{$data->nama}}">
              <td>{{$data->id_anggota}}</td>
              <td>{{$data->nama}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Pegawai-->
<div class="modal fade bd-example-modal-lg" id="myModal3" tabindex="-1" role="dialog"
  aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="table3" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>ID Pegawai</th>
              <th>Nama Pegawai</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data_pegawai as $data)
            <tr class="pilih_pegawai" data-pegawai_id="{{$data->id}}"
              data-pegawai_nama="{{$data->id_pegawai}} - {{$data->nama}}">
              <td>{{$data->id_pegawai}}</td>
              <td>{{$data->nama}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
