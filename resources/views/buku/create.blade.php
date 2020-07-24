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
        <form action="{{route('buku.store')}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group {{ $errors->has('kode_buku') ? ' has-error' : ''}}">
            <label for="kode_buku">Kode buku</label>
            <input id="kode_buku" name="kode_buku" type="text" class="form-control" value="{{ old('kode_buku') }}"
              placeholder="Masukkan Kode Buku" required>
            @if ($errors->has('kode_buku'))
            <span class="help-block">
              <strong>{{ $errors->first('kode_buku') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('judul_buku') ? ' has-error' : '' }}">
            <label for="judul_buku">Judul Buku</label>
            <input id="judul_buku" name="judul_buku" type="text" class="form-control" value="{{ old('judul_buku') }}"
              placeholder="Masukkan Judul Buku" required>
            @if ($errors->has('judul_buku'))
            <span class="help-block">
              <strong>{{ $errors->first('judul_buku') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group">
            <label for="cover" class="control-label">Cover</label>
            <div class="">
              <img width="200" height="200">
              <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
            </div>
          </div>
          <div class="form-group {{ $errors->has('penulis') ? ' has-error' : '' }}">
            <label for="penulis">Penulis</label>
            <input id="penulis" name="penulis" type="text" class="form-control" value="{{ old('penulis') }}"
              placeholder="Masukkan Nama Penulis/Pengarang" required>
            @if ($errors->has('penulis'))
            <span class="help-block">
              <strong>{{ $errors->first('penulis') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group {{ $errors->has('kategori') ? ' has-error' : '' }}">
            <label for="kategori">Kategori</label>
            <select class="form-control" name="kategori" id="kategori" required="required">
              <option value=""> Pilih Kategori </option>
              @foreach($data_kate as $data)
              <option value="{{ $data->id }}">
                {{ $data->kategori }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('kategori'))
            <span class="help-block">
              <strong>{{ $errors->first('kategori') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group {{ $errors->has('rak') ? ' has-error' : '' }}">
            <label for="rak">Kategori</label>
            <select class="form-control" name="rak" id="rak" required="required">
              <option value=""> Pilih Rak</option>
              @foreach($data_rak as $data)
              <option value="{{ $data->id }}">
                {{ $data->rak }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('rak'))
            <span class="help-block">
              <strong>{{ $errors->first('rak') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group {{ $errors->has('penerbit') ? ' has-error' : '' }}">
            <label for="penerbit">Penerbit</label>
            <input id="penerbit" name="penerbit" type="text" value="{{ old('penerbit') }}" class="form-control"
              placeholder="Masukkan Penerbit" required>
            @if ($errors->has('penerbit'))
            <span class="help-block">
              <strong>{{ $errors->first('penerbit') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('tahun_terbit') ? ' has-error' : '' }}">
            <label for="tahun_terbit">Tahun Terbit</label>
            <input id="tahun_terbit" name="tahun_terbit" type="number" value="{{ old('tahun_terbit') }}"
              class="form-control" placeholder="Masukkan Tahun Terbitan Buku" required>
            @if ($errors->has('tahun_terbit'))
            <span class="help-block">
              <strong>{{ $errors->first('tahun_terbit') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('deskripsi') ? ' has-error' : '' }}">
            <label for="deskripsi">Deskripsi Buku</label>
            <textarea id="deskripsi" name="deskripsi" type="text" class="form-control" rows="3"
              placeholder="Masukkan Deskripsi Buku" required>{{ old('deskripsi') }}</textarea>
            @if ($errors->has('deskripsi'))
            <span class="help-block">
              <strong>{{ $errors->first('deskripsi') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('jumlah') ? ' has-error' : '' }}">
            <label for="jumlah">Jumlah Buku</label>
            <input id="jumlah" name="jumlah" type="number" class="form-control" value="{{ old('jumlah') }}"
              placeholder="Masukkan Jumlah Buku" required>
            @if ($errors->has('jumlah'))
            <span class="help-block">
              <strong>{{ $errors->first('jumlah') }}</strong>
            </span>
            @endif
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('buku.index')}}" type="button" class="btn btn-warning">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
