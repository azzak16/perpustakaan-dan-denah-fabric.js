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
          Register
        </h1>
        <p class="text-white link-nav"><a href="index.html">Home </a> <span class="lnr lnr-arrow-right"></span> <a
            href="courses.html"> Daftar</a></p>
      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->

<!-- Start search-course Area -->
<section class="search-course-area relative" style="background: unset">

  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-4 col-md-6 search-course-left">
        <div>
          <img class="img-fluid" src="{{asset('/frontend/img/choose.jpg')}}" alt=""
            style="margin-left:60px; height:300px; width:80%;">
        </div>
        <h1 class="text-center">
          Daftarkan <br>
          Dirimu Sekarang!!!
        </h1>
      </div>
      <div class="col-lg-6 col-md-6 search-course-right section-gap">
        {!! Form::open(['url' => '/postreg','class' => 'form-wrap']) !!}
        <h4 class="pb-20 text-center mb-30">Form Register</h4>
        {!!Form::text('id_anggota', $kode, ['class'=>'form-control', 'hidden', 'placeholder'=>'Nama Lengkap'])!!}
        {!!Form::text('nama', '', ['class'=>'form-control', 'placeholder'=>'Nama Lengkap'])!!}
        {!!Form::text('email', '', ['class'=>'form-control', 'placeholder'=>'Email'])!!}
        {!!Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password'])!!}

        <div class="form-select" id="service-select">
          {!!Form::select('jenis_kelamin', [''=>'Pilih Jenis Kelamin','L'=>'Laki-Laki',
          'P'=>'Perempuan'])!!}
        </div>
        {!!Form::text('agama', '', ['class'=>'form-control', 'placeholder'=>'Agama'])!!}
        {!!Form::text('tempat_lahir', '', ['class'=>'form-control', 'placeholder'=>'Tempat Lahir'])!!}

        <div class="switch-wrap d-flex justify-content-between">
          <label for="">Tanggal Lahir</label>
          {!!Form::date('tgl_lahir', '', ['class'=>'form-control', 'placeholder'=>'Tanggal Lahir'])!!}
        </div>
        {!!Form::number('no_hp', '', ['class'=>'form-control', 'placeholder'=>'No Hp'])!!}
        {!!Form::textarea('alamat', '', ['class'=>'form-control', 'placeholder'=>'Alamat'])!!}

        <input type="submit" class="primary-btn text-uppercase" value="Register" style="text-align: center">
        <div class="text-right">
          <span>Sudah Punya Akun ?<a href="{{ route('login') }}">Login Disini</a></span>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</section>
<!-- End search-course Area -->

<!-- Start cta-two Area -->
<!-- End cta-two Area -->
@endsection
