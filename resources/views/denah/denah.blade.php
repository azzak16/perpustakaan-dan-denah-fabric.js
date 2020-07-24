@section('header')
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
{{-- <link rel="stylesheet" href="{{asset('css/denah.css')}}"> --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@extends('layouts.master')
@section('content')

{{-- alert --}}
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif
{{-- end --}}

{{-- <div class="row">
  <div class="canvas-container col-md-10" style="width: 800px; height: 800px; position: relative; user-select: none;">
    <canvas id="coba" width="800" height="800"
      style="border: 1px solid rgb(170, 170, 170); position: absolute; width: 800px; height: 800px; left: 0px; top: 0px; touch-action: none; user-select: none;"
      class="lower-canvas"></canvas>
  </div> --}}
{{-- <div class="col-md-2 pull-right"> --}}
{{-- <p id="object">0/0</p> --}}
{{-- <input type="text" name="xy" id="object" value="" />
    <button id="add" class="btn btn-default">tambah kotak</button>
    <button id="addWall" class="btn btn-default">wall</button>
    <button id="remove" class="btn btn-default">remove</button>
    <button id="save">Save to JSON</button>
    <button id="restore">Restore form JSON</button> --}}
{{-- <button id="CanvasGrid">Add Grid</button>
    <button id="RemoveGrid">Remove Grid</button> --}}
{{-- </div>
</div> --}}
<div class="row col-md-9">
  <div class="canvas-container">
    <canvas id="coba" width="1000" height="600" style="border:2px solid #000000"></canvas>
  </div>
</div>

<div class="row col-md-3 pull-right">
  {{-- tombol new load --}}
  <div class="form-group">
    <button id="new" type="button" class="btn btn-info" onclick="neW()">Create New</button>
    <button id="ld" type="button" class="btn btn-success" onclick="ld()">Load</button>
  </div>
  {{-- end --}}

  {{-- new --}}
  <div class="form_group">
    <form action="/denah/sv" method="POST" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group hidden" id="div_new">
        <label for="name">nama</label>
        <input id="name" name="name" type="text" class="form-control">
        <textarea class="form-control" id="file" name="file"></textarea>
        <select name="status" class="form-control">
          <option value="tidak">tidak aktif</option>
          <option value="aktif">aktif</option>
        </select>
        <br>
        <label class="btn btn-success tmbl_simpan" id="rasterize-json" onclick="rasterizeJSON()">toJSON</label>
      </div>
      <br>

      {{-- json expand --}}
      <div class="form-group hidden" id="page_simpan">
        <button type="submit" class="btn btn-primary" id="proses_simpan">Simpan</button>
        <label class="btn btn-danger" id="cancel_simpan" onclick="cancelSimpan()">Batal</label>
      </div>
      {{-- end --}}

    </form>
  </div>
  {{-- end --}}

  {{-- load --}}
  <div class="form-group hidden" id="div_load">
    {{-- <button id="load" type="button" class="btn btn-info">Load</button>

    <br> --}}
    <br>
    <label for="name">ubah nama</label>
    <input id="name_up" name="name_up" type="text" class="form-control">
    <textarea class="form-control" id="json-console" bind-value-to="consoleJSON"></textarea>
    <select class="form-control" name="pilih_file" id="pilih_file">
      <option value=""> Pilih File </option>
      @foreach($denahs as $data)
      <option value="{{$data->id}}">{{$data->name}}</option>
      @endforeach
    </select>
    <select name="status" id="status" class="form-control">
      <option value=""> Pilih File </option>
      <option value="aktif">aktif</option>
      <option value="tidak">tidak aktif</option>
    </select>
    <br>
    <button id="proses_update" type="button" class="btn btn-warning" onclick="prosesUpdate()">Update</button>
    <button id="delete" type="button" class="btn btn-danger" onclick="prosesDelete()">Delete</button>
  </div>
  {{-- end --}}

  {{-- tab and pill --}}
  <div class="custom-tabs-line tabs-line-bottom left-aligned">
    <ul class="nav" role="tablist">
      <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Home</a></li>
      <li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Edit</a></li>
    </ul>
  </div>

  {{-- home --}}
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab-bottom-left1">
      <div class="form-group" id="div_gmbr">
        <div class="row col-md-12" style="margin-bottom:10px;">
          <div class="row col-md-3 text-left">
            <label for="">Text</label>
          </div>
          <div class="row col-md-9 pull-right">
            <button id="add_text" style="width:100%;" class="btn btn-default" onclick="addText()">Text</button>
          </div>
        </div>
        <div class="row col-md-12" style="margin-bottom:10px;">
          <div class="row col-md-3 text-left">
            <label for="">Object</label>
          </div>
          <div class="row col-md-9 pull-right">
            <button id="add_kotak" style="width:100%;" class="btn btn-default" onclick="addKotak()">Tambah Rak</button>
            <button id="add_image1" style="width:49%;" class="btn btn-default" onclick="addImage1()">Meja</button>
            <button id="add_image2" style="width:49%;" class="btn btn-default pull-right" onclick="addImage2()">Meja
              2</button>
            <button id="add_image3" style="width:49%;" class="btn btn-default" onclick="addImage3()">Meja 3</button>
            <button id="add_image4" style="width:49%;" class="btn btn-default pull-right" onclick="addImage4()">Meja
              4</button>
            <button id="add_image5" style="width:49%;" class="btn btn-default" onclick="addImage5()">Meja 5</button>
            <button id="add_image6" style="width:49%;" class="btn btn-default pull-right"
              onclick="addImage6()">Jendela</button>
            <button id="add_image7" style="width:49%;" class="btn btn-default" onclick="addImage7()">Pintu</button>
            <button id="add_image8" style="width:49%;" class="btn btn-default pull-right"
              onclick="addImage8()">kursi</button>
            <button id="add_image9" style="width:100%;" class="btn btn-default" onclick="addImage9()">Closed</button>
          </div>
        </div>
        <div class="row col-md-12" style="margin-bottom:10px;">
          <div class="row col-md-3 text-left">
            <label for="">Draw</label>
          </div>
          <div class="row col-md-9 pull-right">
            <button id="drawing-mode" style="width:100%;" class="btn btn-info">Turn On Free Draw</button>
            <button id="line" style="width:100%;" class="btn btn-default">Gambar Line</button>
          </div>
        </div>
        <div class="row col-md-12">
          <div class="row col-md-3 text-left">

          </div>
          <div class="row col-md-9 pull-right">
            <button id="undo" style="width:49%;">Undo</button>
            <button id="redo" class="pull-right" style="width:49%;">Redo</button>
          </div>
        </div>

      </div>
    </div>
    {{-- end home --}}

    {{-- edit --}}
    <div class="tab-pane fade" id="tab-bottom-left2">
      <div class="form-group" id="div_edit" disabled="getSelected()">
        <label for="color">Fill / Stroke / Background:</label>
        <input type="color" style="width:40px" id="fill_color" class="btn-object-action">
        <input type="color" style="width:40px" id="stroke_color" class="btn-object-action">
        <input type="color" style="width:40px" id="bg_color" class="btn-object-action"><br />
        <label for="opacity">Opacity:</label>
        <input value="100" type="range" id="opacity" class="btn-object-action"><br />
        <label for="opacity">Stroke width:</label>
        <input value="1" min="0" max="30" type="range" id="stroke_width" class="btn-object-action"><br />

        <button style="width:50%" id="send-backwards" class="btn btn-default pull-left" onclick="sendBackwards()">Send
          backwards</button>
        <button style="width:50%" id="send-to-back" class="btn btn-default" onclick="sendToBack()">Send
          to back</button>
        <button style="width:50%" id="bring-forward" class="btn btn-default pull-left" onclick="bringForward()">Bring
          forwards</button>
        <button style="width:50%" id="bring-to-front" class="btn btn-default" onclick="bringToFront()">Bring to
          front</button>

        <div id="textControls" style="border:solid; margin-top:5px; text-align:center;" hidden>
          <p style="border-bottom:solid;">Atur Text</p>
          <label for="font-family" style="display:inline-block">Font family:</label><br />
          <select style="width: 150px;" id="font_family" class="btn-object-action">
            <option value="arial" selected>Arial</option>
            <option value="helvetica">Helvetica</option>
            <option value="myriad pro">Myriad Pro</option>
            <option value="delicious">Delicious</option>
            <option value="verdana">Verdana</option>
            <option value="georgia">Georgia</option>
            <option value="courier">Courier</option>
            <option value="comic sans ms">Comic Sans MS</option>
            <option value="impact">Impact</option>
            <option value="monaco">Monaco</option>
            <option value="optima">Optima</option>
            <option value="hoefler text">Hoefler Text</option>
            <option value="plaster">Plaster</option>
            <option value="engagement">Engagement</option>
          </select>
          <br>
          <label for="text-align" style="display:inline-block">Text align:</label><br />
          <select style="width: 150px;" id="text_align" class="btn-object-action">
            <option value="left">Left</option>
            <option value="center">Center</option>
            <option value="right">Right</option>
            <option value="justify">Justify</option>
          </select>
          <div>
            <label for="text-lines-bg-color">Background text color:</label><br />
            <input style="width: 150px;" type="color" size="10" class="btn-object-action" id="textBgColor">
          </div>
          <div>
            <label for="text-font-size">Font size:</label><br />
            <input style="width: 100%;" type="range" value="" min="1" max="120" step="1" class="btn-object-action"
              id="fontSize">
          </div>

          <button style="width:50%;" id="btn-underline" class="btn btn-default pull-left">Underline</button>
          <button style="width:50%;" id="btn-bold" class="btn btn-default">Bold</button>
          <button style="width:50%;" id="btn-italic" class="btn btn-default">Italic</button>


        </div>

      </div>
    </div>
  </div>
</div>
{{-- end edit --}}

{{-- end tab & pill --}}



</div>
@endsection

@section('footer')

<script src="{{asset('dnh/fabric.min.js')}}"></script>
{{-- <script src="{{asset('js/konva.min.js')}}"></script> --}}
<script src="{{asset('dnh/denah.js')}}"></script>
@stop
