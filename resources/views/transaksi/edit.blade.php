@push('script')
<script type="text/javascript">
  $(document).on('click', '.pilih_pegawai', function (e) {
    document.getElementById("namap").value = $(this).attr('data-pegawai_nama');
    document.getElementById("pegawai_id").value = $(this).attr('data-pegawai_id');
    $('#myModal3').modal('hide');
  });
</script>
@endpush
@extends('layouts.master')
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">update</h3>
      </div>
      <div class="panel-body">
        <form action="{{route('transaksi.update', $data_transaksi->id)}}" method="POST">
          {{csrf_field()}}
          {{ method_field('PUT') }}

          <div class="panel-body">
            <div class="form-group{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
              <label for="kode_transaksi" class="col-md-4 control-label">Kode Transaksi</label>
              <div class="col-md-8">
                <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi"
                  value="{{$data_transaksi->kode_transaksi}}" required readonly="">
              </div>
            </div>

            @if ($data_transaksi->status == 'book')
            <div class="form-group {{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
              <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
              <div class="col-md-8">
                <input id="tgl_pinjam" name="tgl_pinjam" type="date"
                  value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" class="form-control"
                  readonly required>
                @if ($errors->has('tgl_pinjam'))
                <span class="help-block">
                  <strong>{{ $errors->first('tgl_pinjam') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group {{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
              <label for="tgl_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
              <div class="col-md-8">
                <input id="tgl_kembali" name="tgl_kembali" type="date"
                  value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(7)->toDateString())) }}"
                  class="form-control" readonly required>
                @if ($errors->has('tgl_kembali'))
                <span class="help-block">
                  <strong>{{ $errors->first('tgl_kembali') }}</strong>
                </span>
                @endif
              </div>
            </div>

            @if (Auth::user()->role == 'ptgs')
            <div class="form-group {{ $errors->has('pegawai_id') ? ' has-error' : '' }}">
              <label for="pegawai_id" class="col-md-4 control-label">Pegawai</label>
              <div class="col-md-8">
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
            </div>
            @else
            <div class="form-group {{ $errors->has('pegawai_id') ? ' has-error' : '' }}">
              <label for="pegawai_id" class="col-md-4 control-label">Pegawai</label>
              {{-- <input id="nama" type="text" class="form-control" value="" readonly="" required> --}}
              <div class="col-md-8">
                <input id="namap" type="text" class="form-control" readonly="" required>
                <input id="pegawai_id" name="pegawai_id" type="hidden" class="form-control" value="" required>
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
            </div>
            @endif

            @else
            <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
              <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
              <div class="col-md-8">
                <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam"
                  value="{{ date('Y-m-d', strtotime($data_transaksi->tgl_pinjam)) }}" readonly="">
              </div>
            </div>
            <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
              <label for="tgl_kembali" class="col-md-4 control-label">Batas Kembali</label>
              <div class="col-md-8">
                <input id="tgl_kembali" type="date" class="form-control" name="tgl_kembali"
                  value="{{ date('Y-m-d', strtotime($data_transaksi->tgl_kembali)) }}" readonly="">
              </div>
            </div>

            <div class="form-group{{ $errors->has('kembali_bnr') ? ' has-error' : '' }}">
              <label for="kembali_bnr" class="col-md-4 control-label">Tanggal Kembali</label>
              <div class="col-md-8">
                <input id="kembali_bnr" type="date" class="form-control"
                  value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" readonly
                  name="kembali_bnr">
              </div>
            </div>

            <div class="form-group">
              <label for="denda" class="col-md-4 control-label">Denda</label>
              <div class="col-md-8">
                <input id="denda" type="text" name="denda" class="form-control" value="{{$denda}}">
              </div>
            </div>

            <div class="form-group">
              <label for="pegawai_id" class="col-md-4 control-label">Pegawai Bertugas</label>
              <div class="col-md-8">
                <input id="pegawai_nama" type="text" class="form-control" readonly=""
                  value="{{$data_transaksi->pegawai->nama}}">
              </div>
            </div>


            <div class="form-group">
              <label for="buku_id" class="col-md-4 control-label">Buku</label>
              <div class="col-md-8">
                <input id="buku" type="text" class="form-control" readonly=""
                  value="{{$data_transaksi->buku->judul_buku}}">
              </div>
            </div>

            <div class="form-group">
              <label for="anggota_id" class="col-md-4 control-label">Anggota Peminjam</label>
              <div class="col-md-8">
                <input id="anggota_nama" type="text" class="form-control" readonly=""
                  value="{{$data_transaksi->anggota->nama}}">
              </div>
            </div>

            <div class="form-group">
              <label for="ket" class="col-md-4 control-label">Keterangan</label>
              <div class="col-md-8">
                <input id="ket" name="ket" type="text" class="form-control" value="{{$data_transaksi->ket}}"
                  placeholder="Masukkan Keterangan Jika Ada">
              </div>
            </div>
            @endif

            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
              <label for="status" class="col-md-4 control-label">Status</label>
              <div class="col-md-2">
                @if ($data_transaksi->status == 'book')
                <select class="form-control" name="status">
                  <option value="batal" {{$data_transaksi->status === "batal" ? "selected" : ""}}>Batal</option>
                  <option value="book" {{$data_transaksi->status === "book" ? "selected" : ""}}>Book</option>
                  <option value="pinjam" {{$data_transaksi->status === "pinjam" ? "selected" : ""}}>Pinjam</option>
                </select>
                @else
                <select class="form-control" name="status">
                  <option value="pinjam" {{$data_transaksi->status === "pinjam" ? "selected" : ""}}>Pinjam</option>
                  <option value="kembali" {{$data_transaksi->status === "kembali" ? "selected" : ""}}>Kembali</option>
                </select>
                @endif
              </div>
            </div>

            <div class="modal-footer col-md-12">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{route('transaksi.show', $data_transaksi->id)}}" type="button"
                class="btn btn-warning">Cancel</a>
            </div>

        </form>
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
