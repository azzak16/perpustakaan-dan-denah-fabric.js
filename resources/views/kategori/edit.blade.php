@extends('layouts.master')
@section('content')


<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Kategori</h3>
      </div>
      <div class="panel-body">
        <form action="{{route('kategori.update', $data_kate->id)}}" method="POST">
          {{csrf_field()}}
          {{ method_field('PUT') }}
          <div class="form-group {{ $errors->has('kategori') ? ' has-error' : ''}}">
            <label for="kategori">Kategori buku</label>
            <input id="kategori" name="kategori" type="text" class="form-control" value="{{$data_kate->kategori}}"
              required>
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
