@push('script')
<script type="text/javascript">
  function readURL() {
      var input = this;
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $(input).prev().attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }

  $(function () {
      $(".uploads").change(readURL)
      $("#f").submit(function(){
          // do ajax submit or just classic form submit
        //  alert("fake subminting")
          return false
      })
  })
</script>
@endpush

@extends('layouts.master')
@section('content')

<h3 class="page-title col-md-9">Tambah Data buku</h3>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Tambah Data</h3>
      </div>
      <div class="panel-body">
        <form action="{{route('buku.update', $data_buku->id)}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          {{ method_field('PUT') }}
          <div class="form-group">
            <label for="kode_buku">Kode buku</label>
            <input id="kode_buku" name="kode_buku" type="text" class="form-control" value="{{$data_buku->kode_buku}}"
              readonly="" required>
          </div>
          <div class="form-group">
            <label for="judul_buku">Judul Buku</label>
            <input id="judul_buku" name="judul_buku" type="text" class="form-control"
              value="{{$data_buku->judul_buku}}">
          </div>
          <div class="form-group">
            <label for="cover" class="control-label">Cover</label>
            <div class="">
              <img width="200" height="200" @if($data_buku->cover) src="{{ asset('images/cover/'.$data_buku->cover) }}"
              @endif>
              <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
            </div>
          </div>
          <div class="form-group">
            <label for="penulis">Penulis</label>
            <input id="penulis" name="penulis" type="text" class="form-control" value="{{$data_buku->penulis}}">
          </div>
          <div class="form-group">
            <label for="penulis">Kategori</label>
            <select class="form-control" name="kategori" id="kategori">

              <option>Pilih Kategori</option>

              @foreach ($kategori as $key => $value)
              <option value="{{ $key }}" {{ ( $key == $selectedID) ? 'selected' : '' }}>
                {{ $value }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="penulis">Rak</label>
            <select class="form-control" name="rak" id="rak">

              <option>Pilih Rak</option>

              @foreach ($rak as $key => $value)
              <option value="{{ $key }}" {{ ( $key == $selectedID2) ? 'selected' : '' }}>
                {{ $value }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="penerbit">Penerbit</label>
            <input id="penerbit" name="penerbit" type="text" class="form-control" value="{{$data_buku->penerbit}}">
          </div>
          <div class="form-group">
            <label for="tahun_terbit">Tahun Terbit</label>
            <input id="tahun_terbit" name="tahun_terbit" type="number" class="form-control"
              value="{{$data_buku->tahun_terbit}}">
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi Buku</label>
            <textarea id="deskripsi" name="deskripsi" type="text" class="form-control"
              rows="3">{{$data_buku->deskripsi}}</textarea>
          </div>
          <div class="form-group">
            <label for="jumlah">Jumlah Buku</label>
            <input id="jumlah" name="jumlah" type="number" class="form-control" value="{{$data_buku->jumlah}}">
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('buku.show', $data_buku->id)}}" type="button" class="btn btn-warning">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
