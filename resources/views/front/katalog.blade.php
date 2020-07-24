@push('script')
<script src="{{asset('dnh/fabric.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    var canvas = new fabric.Canvas('coba');

    canvas.loadFromJSON(
      $("#json-console").val(),
      canvas.renderAll.bind(canvas),
      function (o, object) {
        object.set('selectable', false);
      });


  });

</script>
@endpush
@extends('layouts.frontend')
@section('content')

<section class="banner-area relative about-banner" id="home"
  style="background: url('{{asset('/frontend/img/pma1.jpeg')}}');">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          Katalog
        </h1>
        <p class="text-white link-nav"><a href="/">Home </a> <span class="lnr lnr-arrow-right"></span> <a
            href="/katalog"> Katalog</a></p>
      </div>
    </div>
  </div>
</section>



<!-- Start events-list Area -->
<div class="text-center" style="margin-top:30px;">
  <h1 for="">DENAH PERPUSTAKAAN</h1>
</div>
<section class="events-list-area section-gap event-page-lists">
  <div class="container">
    <div class="col-md-8 col-md-offset-2" style="margin-left:60px;">
      <div class="col-md-10" style="height:700px; margin-bottom:20px; margin-top: -80px;">
        <canvas id="coba" style="border: solid blue 2px; margin-left: -20px;" width="1000" height="600"></canvas>
      </div>
    </div>

    @foreach ($denahs as $item)
    <textarea class="form-control" id="json-console" hidden>{{$item->file}}</textarea>
    @endforeach

    <div class="text-center" style="margin-bottom:50px;">
      <h1 for="">KATALOG BUKU</h1>
    </div>
    <div class="row">
      <div class="col-lg-8 posts-list">
        <div class="row align-items-center">
          @foreach ($bukus as $buku)

          <div class="col-lg-6 pb-30">
            <div class="single-carusel row ">
              <div class="col-6 col-md-4">
                <a href="/katalogdet/{{$buku->id}}"><img class="img-fluid" src="{{($buku->getCover())}}" alt=""></a>
              </div>
              <div class="details col-12 col-md-6">

                <b>Kode Buku</b>
                <p>{{$buku->kode_buku}}</p>

                <b>Judul Buku</b>
                <p>{{$buku->judul_buku}}</p>

                <b>Kategori Buku</b>
                <p>{{$buku->kategori->kategori}}</p>
                {{-- <span class="genric-btn success small">Kode Buku</span>
                <h6>{{$buku->kode_buku}}</h6>
                <br>
                <span class="genric-btn success small">Judul Buku</span>
                <h6>{{$buku->judul_buku}}</h6>
                <br>
                <span class="genric-btn success small">Kategori</span>
                <h6>{{$buku->kategori->kategori}}</h6> --}}
              </div>
            </div>
          </div>

          @endforeach
        </div>
        <nav class="blog-pagination justify-content-center d-flex">
          <span>{{$bukus->links()}}</span>
        </nav>
      </div>
      <div class="col-lg-4 sidebar-widgets">
        <div class="widget-wrap">
          <div class="single-sidebar-widget search-widget">
            <form class="search-form" method="GET" action="/katalog">
              <input placeholder="Cari Buku" name="cari" type="text" onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Search Posts'">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
          <div class="single-sidebar-widget post-category-widget">
            <h4 class="category-title">Kategori Buku</h4>
            <form class="search-form" method="GET" action="/katalog">
              <ul class="cat-list">
                @foreach ($kategoris as $kategori)
                <li value="{{$kategori->id}}">
                  <a href="/katalog/{{$kategori->id}}" name="kateg" class="d-flex justify-content-between">
                    <p>{{$kategori->kategori}}</p>
                  </a>
                </li>
                @endforeach
              </ul>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End events-list Area -->


@endsection
