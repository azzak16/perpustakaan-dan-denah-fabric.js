@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-10">Rak Buku</h3>

<label class="btn btn-primary col-md-2 fa fa-plus-square" data-toggle="modal" data-target="#exampleModal"> Tambah
  Rak</label>

<div class=" row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Data Rak Buku</h3>
        <div class="panel-body">
          <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th class="col-md-2">#</th>
                <th>Rak</th>
                <th class="col-md-4">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_rak as $data)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->rak}}</td>
                <td>
                  <div class="text-center">
                    <form action="{{ route('rak.destroy', $data->id) }}" method="post">
                      <a href="{{route('rak.edit', $data->id)}}" class="btn btn-primary lnr lnr-pencil"></a>

                      {{ csrf_field() }}
                      {{ method_field('delete') }}
                      <label class="btn btn-sm btn-danger"><button disabled class="btn lnr lnr-trash"
                          onclick="return confirm('apa anda yakin ingin menghapus data ini?')"></button></label>
                    </form>
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
        <h3 class="modal-title " id="exampleModalLabel">Form Tambah Rak</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{route('rak.store')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group {{ $errors->has('rak') ? ' has-error' : ''}}">
            <label for="rak">Rak buku</label>
            <input id="rak" name="rak" type="text" class="form-control" value="{{ old('rak') }}"
              placeholder="Masukkan Nama rak" required>
            @if ($errors->has('rak'))
            <span class="help-block">
              <strong>{{ $errors->first('rak') }}</strong>
            </span>
            @endif
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </div>
    </div>
  </div>
</div>





@endsection
