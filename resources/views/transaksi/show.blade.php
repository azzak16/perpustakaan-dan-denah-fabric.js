@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Detail <b>{{$data_transaksi->kode_transaksi}}</h3>
      </div>
      <div class="panel-body">
        <div class="form-group{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
          <label for="kode_transaksi" class="col-md-4 control-label">Kode Transaksi</label>
          <div class="col-md-8">
            <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi"
              value="{{$data_transaksi->kode_transaksi}}" required readonly="">
          </div>
        </div>

        <div class="form-group{{ $errors->has('tgl_book') ? ' has-error' : '' }}">
          <label for="tgl_book" class="col-md-4 control-label">Tanggal Booking</label>
          <div class="col-md-8">
            <input id="tgl_book" type="date" class="form-control" name="tgl_book" value="{{$data_transaksi->tgl_book}}"
              readonly="">
          </div>
        </div>

        <div class="form-group{{ $errors->has('jam_book') ? ' has-error' : '' }}">
          <label for="jam_book" class="col-md-4 control-label">Jam Booking</label>
          <div class="col-md-8">
            <input id="jam_book" type="text" class="form-control" name="jam_book" value="{{$data_transaksi->jam_book}}"
              readonly="">
          </div>
        </div>

        <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
          <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
          <div class="col-md-8">
            <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam"
              value="{{$data_transaksi->tgl_pinjam}}" readonly="">
          </div>
        </div>

        <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
          <label for="tgl_kembali" class="col-md-4 control-label">Batas Kembali</label>
          <div class="col-md-8">
            <input id="tgl_kembali" type="date" class="form-control" name="tgl_kembali"
              value="{{$data_transaksi->tgl_kembali}}" readonly="">
          </div>
        </div>

        <div class="form-group{{ $errors->has('kembali_bnr') ? ' has-error' : '' }}">
          <label for="kembali_bnr" class="col-md-4 control-label">Tanggal Kembali</label>
          <div class="col-md-8">
            <input id="kembali_bnr" type="date" class="form-control" name="kembali_bnr"
              value="{{$data_transaksi->kembali_bnr}}" readonly="">
          </div>
        </div>

        <div class="form-group">
          <label for="denda" class="col-md-4 control-label">Denda</label>
          <div class="col-md-8">
            <input id="denda" type="text" class="form-control" readonly="" value="{{$data_transaksi->denda}}">
          </div>
        </div>

        <div class="form-group">
          <label for="buku_id" class="col-md-4 control-label">Buku</label>
          <div class="col-md-8">
            <input id="buku" type="text" class="form-control" readonly="" value="{{$data_transaksi->buku->judul_buku}}">
          </div>
        </div>

        <div class="form-group">
          <label for="anggota_id" class="col-md-4 control-label">Anggota Peminjam</label>
          <div class="col-md-8">
            <input id="anggota_nama" type="text" class="form-control" readonly=""
              value="{{$data_transaksi->anggota->nama}}">
          </div>
        </div>
        @if ($data_transaksi->status == 'pinjam' && $data_transaksi->status == 'kembali')


        <div class="form-group">
          <label for="pegawai_id" class="col-md-4 control-label">Pegawai Bertugas</label>
          <div class="col-md-8">
            <input id="pegawai_nama" type="text" class="form-control" readonly=""
              value="{{$data_transaksi->pegawai->nama}}">
          </div>
        </div>
        @endif
        <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
          <label for="ket" class=" col-md-4 control-label">Keterangan</label>
          <div class="col-md-8">
            <input id="ket" type="text" class="form-control" name="ket" value="{{ $data_transaksi->ket }}" readonly="">
          </div>
        </div>

        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
          <label for="status" class="col-md-4 control-label">Status</label>

          <div class="col-md-8">
            @if($data_transaksi->status == 'book')
            <span class="label label-warning">Book</span>
            @elseif($data_transaksi->status == 'pinjam')
            <span class="label label-primary">Pinjam</span>
            @elseif($data_transaksi->status == 'batal')
            <span class="label label-danger">Batal</span>
            @else
            <span class="label label-success">Kembali</span>
            @endif
          </div>
        </div>



        <div class="text-right">
          @if(Auth::user()->allowsConfig())
          @if ($data_transaksi->status == 'book')
          <form action="{{ route('transaksi.destroy', $data_transaksi->id) }}" class="pull-right" method="post">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <a href="{{route('transaksi.edit', $data_transaksi->id)}}" class="btn btn-primary col-4">Update</a>
            <button disabled class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">
              Delete
            </button>
          </form>

          @elseif($data_transaksi->status == 'pinjam')
          <a href="{{route('transaksi.edit', $data_transaksi->id)}}" class="btn btn-primary col-4">Update</a>
          @else
          <a href=""></a>
          @endif
          @endif
          <a href="{{route('transaksi.index')}}" class="btn btn-light">Back</a>
        </div>

      </div>
    </div>
  </div>
</div>


@endsection
