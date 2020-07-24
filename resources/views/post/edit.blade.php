@push('script')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script type="text/javascript">
  ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );

        $(document).ready(function(){
        $('#lfm').filemanager('image');
      });
</script>
@endpush

@extends('layouts.master')
@section('header')
<style>
  .ck-editor__editable {
    min-height: 500px;
  }
</style>
@stop
@section('content')

<h3 class="page-title col-md-9">Tambah Post</h3>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Tambah Post</h3>
      </div>
      <div class="panel-body">
        <form action="{{route('post.update', $data_post->id)}}" method="POST">
          {{csrf_field()}}
          {{ method_field('PUT') }}
          <div class="row">
            <div class="col-md-8">
              <div class="form-group {{ $errors->has('title') ? ' has-error' : ''}}">
                <label for="title">Judul Konten</label>
                <input id="title" name="title" type="text" class="form-control" value="{{$data_post->title}}" required>
                @if ($errors->has('title'))
                <span class=" help-block">
                  <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group">
                <label for="content">Konten</label>
                <textarea id="content" name="content" type="text"
                  class="form-control">{{$data_post->content}}</textarea>
              </div>
            </div>

            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-info">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" value="{{$data_post->thumbnail}}"
                  name="thumbnail">
              </div>
              <img id="holder" style=" margin-top:15px;max-height:100px;">
              <div class="input-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('post.index')}}" type="button" class="btn btn-warning">Cancel</a>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
