@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-10">Denda</h3>

<div class=" row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Denda</h3>
        <div class="panel-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Denda</th>
                <th class="col-md-4">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_denda as $data)
              <tr>
                <td>Rp. {{$data->denda}}</td>
                <td>
                  <div class="text-center">

                    <label data-toggle="modal" data-target="#exampleModal"
                      class="btn btn-primary lnr lnr-pencil"></label>

                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- modal --}}
<div class=" modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title " id="exampleModalLabel">edit denda</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{route('denda.update', $data->id)}}" method="POST">
          {{csrf_field()}}
          {{ method_field('PUT') }}
          <div class="form-group {{ $errors->has('denda') ? ' has-error' : ''}}">
            <label for="denda">Denda</label>
            <input id="denda" name="denda" type="text" class="form-control" value="{{$data->denda}}"
              placeholder="Masukkan Nama Kategori" required>
            @if ($errors->has('denda'))
            <span class="help-block">
              <strong>{{ $errors->first('denda') }}</strong>
            </span>
            @endif
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





@endsection
