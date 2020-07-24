@extends('layouts.frontend')

@push('script')
<script>
  $('.multiple-items').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 3,
    dots: true,
  });

</script>
@endpush
@section('content')
<section class="banner-area relative" id="home" style="background: url('{{asset('/frontend/img/pma1.jpeg')}}');">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row fullscreen d-flex align-items-center justify-content-between">
      <div class="banner-content col-lg-9 col-md-12">
        <h1 class="text-uppercase">
          Perpustakaan Medayu Agung Surabaya
        </h1>
        <p class="pt-10 pb-10">
          Dibentuk dari kenangan dan pengalaman pribadi sang pemilik, Oei Hiem Hwie, demi
          membangun sejarah yang lebih besar.
        </p>
      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->

<!-- Start feature Area -->
<section class="feature-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="single-feature">
          <div class="title">
            <h4>Lokasi</h4>
          </div>
          <div class="desc-wrap">
            <p>
              Jl. Medayu Selatan IV/42-44, Rungkut, daerah selatan Surabaya
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature">
          <div class="title">
            <h4>Koleksi</h4>
          </div>
          <div class="desc-wrap">
            <p>
              buku-buku kuno terbitan pertengahan abad 19 hingga awal abad 20
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature">
          <div class="title">
            <h4>Jadwal Buka</h4>
          </div>
          <div class="desc-wrap">
            <p>
              buka dari jam 08.00-16.00
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End feature Area -->

<!-- Start blog Area -->
<section class="blog-area section-gap" id="blog">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="menu-content pb-70 col-lg-8">
        <div class="title text-center">
          <h1 class="mb-10">Buku Terbaru</h1>
        </div>
      </div>
    </div>

    <div class="row multiple-items">
      @foreach ($buku as $data)
      <div class="col mb-4 single-blog">
        <div class="thumb">
          <a href="/katalogdet/{{$data->id}}">
            <img class="img-fluid py-2" src="{{$data->getCover()}}" alt=""
              style="height: 320px; object-fit: cover; object-position: center;">
            <h5 class="text-center">{{$data->judul_buku}}</h5>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!-- End blog Area -->

<!-- Start blog Area -->
<section class="blog-area section-gap" id="blog">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="menu-content pb-70 col-lg-8">
        <div class="title text-center">
          <h1 class="mb-10">Artikel Terbaru</h1>
          <p>Kumpulan Artikel Dan Dokumentasi Perpustakaan Medayu Agung</p>
        </div>
      </div>
    </div>

    <div class="row">
      @foreach ($post as $data)
      <div class="col-lg-3 col-md-6 single-blog">
        <div class="thumb">
          <img class="img-fluid" src="{{$data->getThumbnail()}}" alt="" style=" height:200px; width:100%;">
        </div>
        <p class="meta">{{$data->created_at->diffForHumans()}} | By <a href="#">{{$data->user->name}}</a></p>
        <a href="{{route('site.single.post', $data->slug)}}">
          <h5>{{$data->title}}</h5>
        </a>
        <p class="ArticleBody">
          {{ str_limit(strip_tags($data->content), 250) }}
          @if (strlen(strip_tags($data->content)) > 250)
          ...
          @endif
          <a href="{{route('site.single.post', $data->slug)}}"
            class="details-btn d-flex justify-content-center align-items-center">
            <span class="details">Details</span>
            <span class="lnr lnr-arrow-right"></span>
          </a>
        </p>
        {{-- {!!$data->content!!}
        <a href="{{route('site.single.post', $data->slug)}}"
        class="details-btn d-flex justify-content-center align-items-center">
        <span class="details">Details</span>
        <span class="lnr lnr-arrow-right"></span>
        </a> --}}
      </div>
      @endforeach

    </div>
    <nav class="blog-pagination justify-content-center d-flex">
      <span>{{$post->links()}}</span>
    </nav>


  </div>
</section>
<!-- End blog Area -->

@endsection
