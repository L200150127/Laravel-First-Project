@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "MIM Pucangan")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-isi.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">   
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  {{-- Banner --}}
  @include('components.carousel')

  {{-- Konten utama --}}
  <section id="home">
    <div class="container body-home">
      <div class="row">
        {{-- .col-sm-12 col-md-7 col-lg-7 --}}
        <div class="col-sm-12 col-md-7 col-lg-7" id="col-kiri">
          {{-- Profil Sekolah --}}{{-- .row --}}
          <div class="row" id="Profil-sekolah">
           <div class="col-lg-12">
             <h2 class="jdl">PROFIL SEKOLAH</h2>
             <hr>
           </div>
          </div>{{-- /.row --}}

          {{-- .row --}}
          <div class="row" id="isi-profil-sekolah">
            <div class="col-lg-5" id="col-img-profil">
              <div>
                <img alt="profil-image" src="{{ asset('img/traffic.jpg') }}">
              </div>
            </div>
            <div class="col-lg-7" id="col-text-profil">
              <div>
                <h3>MIM Pucangan</h3>
                <p class="text-justify">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores autem quo sint alias consectetur deserunt praesentium iusto ad quis, reprehenderit, corporis. Recusandae, libero eius voluptates.
                </p>
              </div>
            </div>
          </div>{{-- /.row --}}
          {{-- .row.mt-3 --}}
          <div class="row mt-3" id="Button-profil">
            <div class="col" style="margin:0px;">
              <button class="btn btn-info btn-profil" type="button">Selengkapnya...</button>
            </div>
          </div>{{-- .row.mt-3 --}}
          
          {{-- Artikel-artikel --}}{{-- .row.mt-5 --}}
          <div class="row mt-5" id="Artikel">
            <div class="col-xl-12">
              <h2 class="jdl">ARTIKEL</h2>
              <hr>
            </div>
          </div>{{-- /.row.mt-5 --}}
          
          {{-- .row --}}
          <div class="row" id="isi-artikel">
            {{-- Kolom artikel kiri --}}
            {{-- .col-sm-12.col-md-12.col-lg-6.col-xl-6 --}}
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6" 
            id="col-artikel1">
              <div>
                <img alt="cover-artikel" src="{{ asset('img/benches.jpg') }}">
                <h4 class="mt-1">Judul Artikel</h4>
                <span>
                  <i class="fas fa-calendar"></i>
                  <small class="text-muted">21/05/2018</small>
                </span>
                <p class="text-justify mt-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum cumque iure placeat reprehenderit labore obcaecati, esse nobis id, veritatis nesciunt saepe velit dolore a fugit...<br></p>
              </div>
            </div>{{-- /.col-sm-12.col-md-12.col-lg-6.col-xl-6 --}}

            {{-- Kolom artikel kanan --}}
            {{-- .col-sm-12.col-md-12.col-lg-6.col-xl-6 --}}
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6" 
            id="col-artikel2">
              <hr id="hr-hide">
              <div class="row" id="row-artikel1">
                <div class="col-6 col-lg-5">
                  <div id="1div-img-artikel2">
                    <img alt="cover-artikel" 
                    src="{{ asset('img/rocks.jpg') }}">
                  </div>
                </div>
                <div class="col-6 col-lg-7">
                  <div id="1div-text-artikel2">
                    <h6>Heading</h6>
                    <span style="font-size: 80%">
                      <i class="fas fa-calendar"></i>
                      <small class="text-muted">21/05/2018</small>
                    </span>
                    <p style="font-size: 80%" class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, dolorem...</p>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row" id="row-artikel2">
                <div class="col-6 col-lg-5">
                  <div id="2div-img-artikel2">
                    <img alt="cover-artikel" 
                    src="{{ asset('img/bridge.jpg') }}">
                  </div>
                </div>
                <div class="col-6 col-lg-7">
                  <div id="2div-text-artikel2">
                    <h6>Heading</h6>
                    <span style="font-size: 80%">
                      <i class="fas fa-calendar"></i>
                      <small class="text-muted">21/05/2018</small>
                    </span>
                    <p style="font-size: 80%" class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, aliquid...</p>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row" id="row-artikel3">
                <div class="col-6 col-lg-5">
                  <div id="2div-img-artikel2">
                    <img alt="cover-artikel" 
                    src="{{ asset('img/rails.jpg') }}">
                  </div>
                </div>
                <div class="col-6 col-lg-7">
                  <div id="2div-text-artikel2">
                    <h6>Heading</h6>
                    <span style="font-size: 80%">
                      <i class="fas fa-calendar"></i>
                      <small class="text-muted">21/05/2018</small>
                    </span>
                    <p style="font-size: 80%" class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, magnam...</p>
                  </div>
                </div>
              </div>
            </div>{{-- /.col-sm-12.col-md-12.col-lg-6.col-xl-6 --}}
          </div>{{-- /.row --}}
          
          {{-- .row --}}
          <div class="row" id="Button-artikel">
            <div class="col"><button class="btn btn-info btn-profil" 
              type="button">Selengkapnya...</button></div>
          </div>{{-- /.row --}}

          {{-- Galeri Foto --}}{{-- .row.mt-5 --}}
          <div class="row mt-5" id="galeri">
            <div class="col-10 col-lg-10 col-xl-10">
              <h2 class="jdl">GALERI&nbsp;</h2>
            </div>
            <div class="col-2 col-lg-2 col-xl-2">
              <div>
                <a href="#">
                  <i class="fa fa-image tada animated infinite"></i>
                </a>
              </div>
            </div>
          </div>{{-- /.row.mt-5 --}}
          <hr>

          {{-- .row.no-gutters --}}{{-- #isi-galeri --}}
          <div class="row no-gutters" id="isi-galeri" 
          style="margin:0px 0px 15px 0px;">
            <div class="col">
              <div id="galeriCarousel" class="carousel slide w-100" 
              data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">

                  <div class="carousel-item row no-gutters active">
                    <div class="col-3 float-left">
                      <img alt="thumbnail-galeri-foto" class="img-fluid" 
                      src="{{ asset('img/slider_1.jpg') }}">
                    </div>
                    <div class="col-3 float-left">
                      <img alt="thumbnail-galeri-foto" class="img-fluid" 
                      src="{{ asset('img/slider_2.jpg') }}">
                    </div>
                    <div class="col-3 float-left">
                      <img alt="thumbnail-galeri-foto" class="img-fluid" 
                      src="{{ asset('img/slider_3.jpg') }}">
                    </div>
                    <div class="col-3 float-left">
                      <img alt="thumbnail-galeri-foto" class="img-fluid" 
                      src="{{ asset('img/slider_4.jpg') }}">
                    </div>
                  </div>

                  <div class="carousel-item row no-gutters">
                    <div class="col-3 float-left">
                      <img alt="thumbnail-galeri-foto" class="img-fluid" 
                      src="{{ asset('img/slider_1.jpg') }}">
                    </div>
                    <div class="col-3 float-left">
                      <img alt="thumbnail-galeri-foto" class="img-fluid" 
                      src="{{ asset('img/slider_2.jpg') }}">
                    </div>
                    <div class="col-3 float-left">
                      <img alt="thumbnail-galeri-foto" class="img-fluid" 
                      src="{{ asset('img/slider_3.jpg') }}">
                    </div>
                    <div class="col-3 float-left">
                      <img alt="thumbnail-galeri-foto" class="img-fluid" 
                      src="{{ asset('img/slider_4.jpg') }}">
                    </div>
                  </div>

                </div>

                <a class="carousel-control-prev" href="#galeriCarousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#galeriCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>

            </div>
          </div>{{-- /.row.no-gutters --}}{{-- /#isi-galeri --}}
        </div>{{-- /.col-sm-12 col-md-7 col-lg-7 --}}

         {{-- .col-sm-12 col-md-5 col-lg-5 --}}
         <div class="col-sm-12 col-md-5 col-lg-5" id="col-kanan">
           @include('partials._agenda')
           @include('partials._unduhan')
           @include('partials._statistik')
         </div>{{-- /.col-sm-12 col-md-5 col-lg-5 --}}
      </div>

    </div>
  </section>

  {{-- Footer --}}
  @include('partials._footer_web')
@endsection

@push('scripts')
    <!-- core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript" charset="utf-8" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
@endpush
