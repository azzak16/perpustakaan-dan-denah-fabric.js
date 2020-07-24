@extends('layouts.master')
@section('content')


<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Rak</h3>
      </div>
      <div class="panel-body">
        <form action="{{route('rak.update', $data_rak->id)}}" method="POST">
          {{csrf_field()}}
          {{ method_field('PUT') }}
          <div class="form-group {{ $errors->has('rak') ? ' has-error' : ''}}">
            <label for="rak">Rak buku</label>
            <input id="rak" name="rak" type="text" class="form-control" value="{{$data_rak->rak}}" required>
            @if ($errors->has('rak'))
            <span class="help-block">
              <strong>{{ $errors->first('rak') }}</strong>
            </span>
            @endif
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('rak.index')}}" type="button" class="btn btn-warning">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
