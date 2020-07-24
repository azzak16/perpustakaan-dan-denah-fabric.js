@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-9">Tambah Data Kategori</h3>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Tambah Data Kategori</h3>
      </div>
      <div class="panel-body">
        <form action="{{route('kategori.store')}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group {{ $errors->has('kategori') ? ' has-error' : ''}}">
            <label for="kategori">Kategori buku</label>
            <input id="kategori" name="kategori" type="text" class="form-control" value="{{ old('kategori') }}"
              placeholder="Masukkan Nama Kategori" required>
            @if ($errors->has('kategori'))
            <span class="help-block">
              <strong>{{ $errors->first('kategori') }}</strong>
            </span>
            @endif
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('kategori.index')}}" type="button" class="btn btn-warning">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
