@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Semua Artikel")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-artikel.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
  <section id="artikel-menu">
      <div class="container artikel-menu-container">
          <div class="h1-judul">
              <h1 class="text-center"><strong>ARTIKEL</strong></h1>
              <p class="page-description text-center">Semua Artikel</p>
          </div>
          <div class="row">
            @foreach ($artikel as $arti)
              <div class=" col-md-6 col-lg-4 col-xl-4">
                 
                      <div class="card" id="thumb-kategori">
                          @if ($arti->gambar_cover)
                          <img alt="cover-artikel" id="img-artikel"
                          class="card-img-top rounded-top" width="250" height="200"
                          style="object-fit: cover;"
                          src="{{ asset('storage/foto/artikel/' . $arti->gambar_cover) }}">
                          @else
                          <img alt="cover-artikel" class="card-img-top rounded-top" width="250" height="200"
                          style="object-fit: cover;" 
                          src="/storage/default/images/cover_default.png">
                          @endif
                          <div class="card-body">
                              <h4 class="text-primary card-title">
                                {{ substr(($arti->judul), 0, 50) }}
                                {{ strlen(($arti->judul)) > 50 ? "..." : "" }}<br>
                              </h4>
                              <p style="color:rgb(153,153,153);">
                                {{ 
                                  $arti->created_at->formatLocalized('%A, %d %B %Y %H:%I') 
                                }}
                              </p>
                              <p class="text-justify card-text">
                                {{ substr(strip_tags($arti->isi), 0, 100) }}
                                {{ strlen(strip_tags($arti->isi)) > 100 ? "..." : "" }}<br>
                              </p>
                              <div class="div-btn">
                                <a href="{{ route('blog.single', $arti->slug) }}" class="btn btn-warning btn-artikel">
                                  <strong>BACA ARTIKEL</strong><br>
                                </a>
                              </div>
                          </div>
                      </div>
              </div>
            @endforeach
              
              
          </div>
          <div class="row justify-content-center mt-5">
                  <div class="col-lg-3 col-xl-3">
                    <nav aria-label="Paginasi">
                      {!! $artikel->links(); !!}
                    </nav>
                  </div>
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
    <script src="{{ asset('js/bs-animation.js') }}"></script>
@endpush
