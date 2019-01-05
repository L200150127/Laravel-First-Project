@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Janji Pelajar Muhammadiyah")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-janji.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  {{-- Konten utama --}}
  <section id="janji-p">
      <div class="container janji-container">


          <div class="row row-janji mt-4">
              <div class="text-center w-100 mb-5">
                <h1><strong>Janji Pelajar Muhammadiyah</strong>
                </h1>
              </div>

              <div class="col-12 col-xl-12">
                  <p class="mb-5"><strong>KAMI PELAJAR MUHAMMADIYAH BERJANJI :&nbsp;</strong><br></p>
              </div>
              <div class="col-1 col-sm-2 col-md-1 col-lg-1 col-xl-1" >
                  <p class="text-center"><strong>1.</strong><br></p>
              </div>
              <div class="col-10 col-sm-10 col-md-11 col-lg-11 col-xl-11">
                  <p>MENJUNJUNG TINGGI PERINTAH AGAMA ISLAM<br></p>
              </div>
              <div class="col-xl-12">
                  <hr>
              </div>
              <div class="col-1 col-sm-2 col-md-1 col-lg-1 col-xl-1" >
                  <p class="text-center"><strong>2.</strong></p>
              </div>
              <div class="col-10 col-sm-10 col-md-11 col-lg-11 col-xl-11">
                  <p>HORMAT DAN PATUH TERHADAP ORANG TUA DAN GURU<br></p>
              </div>
              <div class="col-xl-12">
                  <hr>
              </div>
              <div class="col-1 col-sm-2 col-md-1 col-lg-1 col-xl-1" >
                  <p class="text-center"><strong>3.</strong><br></p>
              </div>
              <div class="col-10 col-sm-10 col-md-11 col-lg-11 col-xl-11">
                  <p>BERSIH LAHIR BATIN DAN TEGUH HATI<br></p>
              </div>
              <div class="col-xl-12">
                  <hr>
              </div>
              <div class="col-1 col-sm-2 col-md-1 col-lg-1 col-xl-1" >
                  <p class="text-center"><strong>4.</strong><br></p>
              </div>
              <div class="col-10 col-sm-10 col-md-11 col-lg-11 col-xl-11">
                  <p>RAJIN BELAJAR, GIAT BEKERJA SERTA BERAMAL SHOLEH<br></p>
              </div>
              <div class="col-xl-12">
                  <hr>
              </div>
              <div class="col-1 col-sm-2 col-md-1 col-lg-1 col-xl-1" >
                  <p class="text-center"><strong>5.</strong><br></p>
              </div>
              <div class="col-10 col-sm-10 col-md-11 col-lg-11 col-xl-11">
                  <p>BERGUNA BAGI MASYARAKAT BANGSA DAN AGAMA&nbsp;<br></p>
              </div>
              <div class="col-xl-12">
                  <hr>
              </div>
              <div class="col-1 col-sm-2 col-md-1 col-lg-1 col-xl-1" >
                  <p class="text-center"><strong>6.</strong><br></p>
              </div>
              <div class="col-10 col-sm-10 col-md-11 col-lg-11 col-xl-11">
                  <p>SANGGUP MELAKSANAKAN AMAL USAHA MUHAMMADIYAH<br></p>
              </div>
              <div class="col-xl-12">
                  <hr>
              </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
@endpush
