@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-10">Post Buku</h3>

<a href="{{route('post.create')}}" class="btn btn-primary col-md-2 fa fa-plus-square"> Buat Post</a>

<div class=" row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Data Post</h3>
        <div class="panel-body">
          <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th class="col-md-2">#</th>
                <th>title</th>
                <th>User</th>
                <th class="col-md-3">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_post as $data)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->title}}</td>
                <td>{{$data->user->name}}</td>
                <td>
                  <div class="text-center">
                    <form action="{{ route('post.destroy', $data->id) }}" method="post">
                      <a target="_blank" href="{{route('site.single.post', $data->slug)}}"
                        class="btn btn-primary lnr lnr-eye"></a>
                      <a href="{{route('post.edit', $data->id)}}" class="btn btn-warning lnr lnr-pencil"></a>

                      {{ csrf_field() }}
                      {{ method_field('delete') }}
                      <label class="btn btn-sm btn-danger"><button class="btn lnr lnr-trash"
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






@endsection
