@extends('layouts.frontend')

@section('content')
<!-- start banner Area -->
<section class="banner-area relative" id="home" style="background: url('{{asset('/frontend/img/pma1.jpeg')}}');">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          Detail Artikel
        </h1>
        <p class="text-white link-nav"><a href="index.html">Home </a> <span class="lnr lnr-arrow-right"></span> <a
            href="blog-single.html"> Blog
            Details Page</a></p>
      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->

<!-- Start post-content Area -->
<section class="post-content-area single-post-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 posts-list">
        <div class="single-post row">
          <div class="col-lg-12">
            <div class="feature-img">
              <img class="img-fluid" src="{{$post->getThumbnail()}}" alt="">
            </div>
          </div>
          <div class="col-lg-3  col-md-3 meta-details">
            {{-- <ul class="tags">
                  <li><a href="#">Food,</a></li>
                  <li><a href="#">Technology,</a></li>
                  <li><a href="#">Politics,</a></li>
                  <li><a href="#">Lifestyle</a></li>
                </ul> --}}
            <div class="user-details row">
              <p class="user-name col-lg-12 col-md-12 col-6"><a href="#">{{$post->user->name}}</a> <span
                  class="lnr lnr-user"></span></p>
              <p class="date col-lg-12 col-md-12 col-6"><a href="#">{{$post->created_at->format('d M Y')}}</a> <span
                  class="lnr lnr-calendar-full"></span></p>
            </div>
          </div>
          <div class="col-lg-9 col-md-9">
            <h3 class="mt-20 mb-20">{{$post->title}}</h3>
            {!!$post->content!!}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End post-content Area -->

@endsection
