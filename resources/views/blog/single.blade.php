@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , htmlspecialchars($artikel->judul))

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-isi-artikel.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
  <section id="artikel-isi">
      <div class="container artikel-isi-container">
          <div class="row">
              <div class="col-md-8">
                  <div class="div-col-kiri">
                    @if ($artikel->gambar_cover)
                      <div class="div-img">
                        <img class="img-thumbnail img-fluid" src="{{ asset('storage/foto/artikel/' . $artikel->gambar_cover) }}">
                      </div>
                    @else
                      <div class="div-img">
                        <img class="img-thumbnail" 
                        src="{{ asset('storage/default/images/cover_default.png') }}">
                      </div>
                    @endif
                      
                      <h1 class="mt-3 mb-3"><strong>{{ $artikel->judul }}</strong></h1>
                      <p class="text-justify">
                        {!! $artikel->isi !!}
                      </p>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="div-col-kanan">
                      <h2><strong>Postingan Terbaru</strong></h2>
                      <hr>
                      @foreach ($artikelTerbaru as $art)
                        <div class="row row-posting">
                            <div class="col-md-12 col-lg-6 col-xl-6">
                              @if ($art->gambar_cover)
                                <div class="div-img">
                                  <a href="{{ route('blog.single', $art->slug) }}" >
                                    <img class="img-thumbnail w-100" 
                                    src="{{ asset('storage/foto/artikel/' . $art->gambar_cover) }}" 
                                    alt="gambar_cover" height="200"
                                    style="object-fit: cover;" >
                                  </a>
                                  
                                </div>
                              @else
                                <div class="div-img">
                                  <a href="{{ route('blog.single', $art->slug) }}" >
                                    <img class="img-thumbnail w-100" 
                                    src="{{ asset('storage/default/images/cover_default.png') }}"
                                    height="200" alt="gambar_cover"
                                    style="object-fit: cover;" >
                                  </a>
                                </div>
                              @endif
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6 mt-2">
                                <div class="post-text">
                                    <h5>
                                      {{ $art->judul }}
                                    </h5>
                                    <p class="mt-2">
                                      {{ 
                                        $art->created_at->formatLocalized('%d %B %Y') 
                                      }}
                                    </p>
                                </div>
                            </div>
                        </div>
                      @endforeach
                      
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
@endpush
