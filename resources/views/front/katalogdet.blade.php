@extends('layouts.frontend')

@section('content')
<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home"
  style="background: url('{{asset('/frontend/img/pma1.jpeg')}}');">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          Katalog Detail
        </h1>
        <p class="text-white link-nav"><a href="/">Home </a> <span class="lnr lnr-arrow-right"></span> <a
            href="/katalog"> Katalog</a></p>
      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->

<!-- Start post-content Area -->
<section class="event-details-area section-gap">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 event-details-left">
        <div class="main-img">
          <h1 class="border">{{$bukus->judul_buku}}</h1>
          <br>
          <img class="img-fluid" src="{{$bukus->getCover()}}" height="300x" width="360x" alt="Avatar">
        </div>
        <div class="details-content">
          <a href="#">
            <h4>Deskripsi Buku</h4>
          </a>
          <blockquote class="generic-blockquote">
            {{$bukus->deskripsi}}
          </blockquote>
        </div>
        <div class="social-nav row no-gutters">
          <div class="col-lg-6 col-md-6 ">
            <ul class="focials">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a href="#"><i class="fa fa-behance"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-4 event-details-right">
        <a class="genric-btn danger radius medium pull-right" href="{{ URL::previous() }}">Back</a>
        <div class="single-event-details">
          <h4>Details</h4>
          <ul class="mt-10">
            <li class="justify-content-between d-flex">
              <span>Kode Buku</span>
              <span>{{$bukus->kode_buku}}</span>
            </li>
            <li class="justify-content-between d-flex">
              <span>Judul Buku</span>
              <span>{{$bukus->judul_buku}}</span>
            </li>
            <li class="justify-content-between d-flex">
              <span>Kategori Buku</span>
              <span>{{$bukus->Kategori->kategori}}</span>
            </li>
            <li class="justify-content-between d-flex">
              <span>Penulis</span>
              <span>{{$bukus->penulis}}</span>
            </li>
            <li class="justify-content-between d-flex">
              <span>Penerbit</span>
              <span>{{$bukus->penerbit}}</span>
            </li>
            <li class="justify-content-between d-flex">
              <span>Tahun Terbit</span>
              <span>{{$bukus->tahun_terbit}}</span>
            </li>
            <li class="justify-content-between d-flex">
              <span>Tempat</span>
              <span>{{$bukus->rak->rak}}</span>
            </li>
            <li class="justify-content-between d-flex">
              <span>Jumlah</span>
              <span>{{$bukus->jumlah}}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End post-content Area -->
@endsection
