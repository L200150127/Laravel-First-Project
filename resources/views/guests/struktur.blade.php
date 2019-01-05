@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Struktur Organisasi")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-so.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
  <section id="so">
          <div class="container so-container">
            
            <div class="h1-judul">
              <h1 class="text-center"><b>Struktur Organisasi</b></h1>
              
            </div>
          
            <div class="row" id="row-kepala-sekolah">
                <div class="col-3 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                    <div id="garis-kiri"></div>
                </div>
                <div class="col-8 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin:0px -35px;">
                    <div id="text-so">
                        <h3>Kepala Sekolah</h3>
                    </div>
                </div>
                <div class="col-3 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                    <div id="garis-kanan"></div>
                </div>
            </div>
            <div class="row justify-content-center" id="row-foto-so">
              @foreach ($kepalaSekolah as $kepSek)
                <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-3">
                    <div class="foto-so">
                        @if ($kepSek->foto)
                          <div class="cover-foto"><img src="{{ asset('storage/foto/guru/' . $kepSek->foto) }}" data-bs-hover-animate="pulse"></div>
                        @else
                          <div class="cover-foto"><img src="/img/avatar-so.png" data-bs-hover-animate="pulse"></div>
                        @endif
                        <div id="text-foto" style="font-family:Anaheim, sans-serif;">
                            <h4>{{ $kepSek->nama }}</h4>
                            <p>{{ $kepSek->jabatan }}</p>
                        </div>
                    </div>
                </div>
              @endforeach
                
            </div>
            <div class="row" id="row-komite-sekolah">
                <div class="col-3 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                    <div id="garis-kiri"></div>
                </div>
                <div class="col-8 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin:0px -35px;">
                    <div id="text-so">
                        <h3>Komite Sekolah</h3>
                    </div>
                </div>
                <div class="col-3 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                    <div id="garis-kanan"></div>
                </div>
            </div>
            <div class="row justify-content-center" id="row-foto-so">
              @foreach ($komiteSekolah as $ks)
                <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-3">
                    <div class="foto-so">
                        @if ($ks->foto)
                          <div class="cover-foto"><img src="{{ asset('storage/foto/guru/' . $ks->foto) }}" data-bs-hover-animate="pulse"></div>
                        @else
                          <div class="cover-foto"><img src="/img/avatar-so.png" data-bs-hover-animate="pulse"></div>
                        @endif
                        <div id="text-foto" style="font-family:Anaheim, sans-serif;">
                            <h4>{{ $ks->nama }}</h4>
                            <p>{{ $ks->jabatan }} {{ $loop->iteration }}</p>
                        </div>
                    </div>
                </div>
              @endforeach
            </div>
            <div class="row" id="row-bendahara-sekolah">
                <div class="col-3 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                    <div id="garis-kiri"></div>
                </div>
                <div class="col-8 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin:0px -35px;">
                    <div id="text-so">
                        <h3>Bendahara</h3>
                    </div>
                </div>
                <div class="col-3 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                    <div id="garis-kanan"></div>
                </div>
            </div>
            <div class="row justify-content-center" id="row-foto-so">
                @foreach ($bendahara as $benda)
                  <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-3">
                      <div class="foto-so">
                          @if ($benda->foto)
                            <div class="cover-foto"><img src="{{ asset('storage/foto/guru/' . $benda->foto) }}" data-bs-hover-animate="pulse"></div>
                          @else
                            <div class="cover-foto"><img src="/img/avatar-so.png" data-bs-hover-animate="pulse"></div>
                          @endif
                          <div id="text-foto" style="font-family:Anaheim, sans-serif;">
                              <h4>{{ $benda->nama }}</h4>
                              <p>{{ $benda->jabatan }} {{ $loop->iteration }}</p>
                          </div>
                      </div>
                  </div>
                @endforeach
            </div>
            <div class="row" id="row-unit-perpus-sekolah">
                <div class="col-3 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                    <div id="garis-kiri"></div>
                </div>
                <div class="col-8 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin:0px -35px;">
                    <div id="text-so">
                        <h3>Unit Perpustakaan</h3>
                    </div>
                </div>
                <div class="col-3 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                    <div id="garis-kanan"></div>
                </div>
            </div>
            <div class="row justify-content-center" id="row-foto-so">
              @foreach ($unitPerpus as $up)
                <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-3">
                    <div class="foto-so">
                        @if ($up->foto)
                          <div class="cover-foto"><img src="{{ asset('storage/foto/guru/' . $up->foto) }}" data-bs-hover-animate="pulse"></div>
                        @else
                          <div class="cover-foto"><img src="/img/avatar-so.png" data-bs-hover-animate="pulse"></div>
                        @endif
                        <div id="text-foto" style="font-family:Anaheim, sans-serif;">
                            <h4>{{ $up->nama }}</h4>
                            <p>{{ $up->jabatan }} {{ $loop->iteration }}</p>
                        </div>
                    </div>
                </div>
              @endforeach
                
            </div>
            <div class="row" id="row-wali-sekolah">
                <div class="col-3 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                    <div id="garis-kiri"></div>
                </div>
                <div class="col-8 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin:0px -35px;">
                    <div id="text-so">
                        <h3>Wali Kelas</h3>
                    </div>
                </div>
                <div class="col-3 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                    <div id="garis-kanan"></div>
                </div>
            </div>
            <div class="row justify-content-start" id="row-foto-so">
              @foreach ($waliKelas as $wk)
                <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-3">
                    <div class="foto-so">
                        @if ($wk->guru->foto)
                          <div class="cover-foto"><img src="{{ asset('storage/foto/guru/' . $wk->guru->foto) }}" data-bs-hover-animate="pulse"></div>
                        @else
                          <div class="cover-foto"><img src="/img/avatar-so.png" data-bs-hover-animate="pulse"></div>
                        @endif
                        <div id="text-foto" style="font-family:Anaheim, sans-serif;">
                            <h4>{{ $wk->guru->nama }}</h4>
                            <p>Wali {{ $wk->nama }}</p>
                        </div>
                    </div>
                </div>
              @endforeach
                
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
