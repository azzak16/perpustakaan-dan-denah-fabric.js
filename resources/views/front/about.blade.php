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
          About Us
        </h1>
        <p class="text-white link-nav"><a href="index.html">Home </a> <span class="lnr lnr-arrow-right"></span> <a
            href="about.html"> About Us</a></p>
      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->

<!-- Start feature Area -->
<section class="feature-area pb-120">

</section>
<!-- End feature Area -->

<!-- Start info Area -->
<section class="info-area pb-120">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-lg-6 no-padding info-area-left">
        <img class="img-fluid" src="{{asset('/frontend/img/Medayu1.jpg')}}" alt=""
          style="margin-left:100px; height:300px; width:80%;">
      </div>
      <div class="col-lg-6 info-area-right">
        <h1>Pembentukan Yayasan</h1>
        <p>Untuk tujuan tersebut diatas, kami membentuk sebuah yayasan yang memiliki kekuatan hukum sebagai wadah
          perpustakaan. Dengan terbentuknya yayasan, kami dapat menggalang dana serta membuat program kerja untuk
          mengembangkan perpustakaan dan usaha-usaha lain yang sifatnya mendukung kemajuan perpustakaan. Perpustakaan
          ini disahkan pada tanggal 1 Desember 2001</p>
      </div>
    </div>
  </div>
  <div class="whole-wrap">
    <div class="container">
      <div class="section-top-border">
        <h3 class="mb-30">Asas dan Tujuan</h3>
        <div class="row">
          <div class="col-md-9 mt-sm-20 left-align-p">
            <p>yayasan ini berazaskan pancasila sebagai satu-sataunya azas dalam kehidupan bermasyarakat, berbangsa dan
              bernegara. maksu dan tujuan didirikannya yayasan ini adalah untuk aktif mengembangkan dan membantu
              masyarakat dalam usaha mencerdaskan kehidupan bangsa, menumbuhkan semangat dan membentuk "nation and
              character building" yang ikut berperan secara aktif dan peduli terhadap perkembangan seni dan budaya
              indonesia serta tidak meninggalkan sejarah untuk menganalisa setiap fenomena yang terjadi di indonesia dan
              menjadikan sejarah sebagai cermin untuk melangkah ke masa depan. ikut mendidik generasi muda mencintai
              ilmu pengetahuan dan menumbuhkan semangat belajar dan membaca</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End info Area -->

<!-- Start course-mission Area -->
<!-- End course-mission Area -->


<!-- Start review Area -->
<!-- End review Area -->

<!-- Start cta-two Area -->
<!-- End cta-two Area -->
@endsection
