@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Galeri Foto")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles-galeri.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
      <section id="gallery-block" class="compact-gallery">
        <div class="container gallery-container">
          <div class="h1-judul">
            <h1><strong>Galeri Kegiatan</strong></h1>
              </div>
              <p class="page-description text-center">MIM Pucangan</p>
          
          <div class="row no-gutters">
            @foreach ($galeri as $foto)
              <div class="col-md-6 col-lg-4 item zoom-on-hover">
                <a class="lightbox" href="{{ asset('storage/foto/' . $foto->path) }}">
                  <img class="img-fluid image" src="{{ asset('storage/foto/' . $foto->path) }}" alt="{{ $foto->nama }}">
                  <span class="description">
                    <span class="description-heading">
                      {{ $foto->nama }}
                    </span>
                    <span class="description-body">
                      {{ $foto->deskripsi }}
                    </span>
                  </span>
                </a>
              </div>    
            @endforeach
              
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.compact-gallery',{animation:'slideIn'});
    </script>
@endpush
