@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Surat Izin Operasional")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-izinop.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
  <section id="izin-op">
      <div class="container izin-container">
          <div class="row">
              <div class="col-12 col-sm-6">
                  <div class="w-100 m-auto"><img src="{{ asset('img/izin-op1.png') }}" class="w-100"></div>
              </div>
              <div class="col-12 col-sm-6">
                  <div class="w-100 m-auto"><img src="{{ asset('img/izin-op2.png') }}" class="w-100"></div>
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
