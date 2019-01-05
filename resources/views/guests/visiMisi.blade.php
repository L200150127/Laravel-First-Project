@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Profil Sekolah")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-profil.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  {{-- Konten utama --}}
  <section id="profil-sek">
      <div class="container profil-container">
          <div class="h1-judul">
              <h1 class="text-center"><strong>Profil Sekolah</strong></h1>
          </div>
      

          

          <div class="row" id="row-svmt">
              <div class="col-xl-12">
                  <div class="sejarah">
                      <h2 style="font-family:Acme, sans-serif;">Sejarah Sekolah</h2>
                  </div>
                  <div class="isi-sejarah"><img src="{{ asset('img/IMG_4005.jpg') }}" alt="gambar-profil-sekolah">
                      <p class="text-justify" style="font-size: 20px;">MI Muhammadiyah Pucangan yang beralamat di Gunung RT 01 / XI Desa Pucangangan Kecamatan Kartasura, Kabupaten Sukoharjo didirikan pada tanggal 1 Agustus 1965 di tanah wakaf Bp. Gurtubi kepada Pengurus Ranting Muhammadiyah pucangan. 
  Alhamdulilah sampai sekarang MI Muhammadiyah Pucangan selalu mendapat dukungan dan bantuan dari masyarakat sekitar sehinggan keberadaan MI Muhammadiyah Pucangan tetap eksis.
  <br></p>
                  </div>
              </div>
              <div class="col mt-5 mb-4">
                  <div>
                      <ul class="nav nav-tabs">
                          <li class="nav-item">
                              <a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1">
                                  <h2>Visi</h2>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" role="tab" data-toggle="tab" href="#tab-2">
                                  <h2>Misi</h2>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" role="tab" data-toggle="tab" href="#tab-3">
                                  <h2>Tujuan</h2>
                              </a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" role="tabpanel" id="tab-1" >
                              <div class="div-tabparagraf" style="height: 200px">
                                  <p class="text-justify" style="font-size: 20px;font-weight: bold; ">Terwujudnya lulusan yang menguasai ilmu pengetahuan, berakhalaq mulia, bertaqwa kepada Allah SWT berprestasi dan siap menghadapi tantangan di era globalisasi.</p>
                              </div>
                          </div>
                          <div class="tab-pane" role="tabpanel" id="tab-2">
                              <div class="div-tabparagraf" style="height: 200px">
                                  <p class="text-justify" style="font-size: 20px; font-weight: bold;">
                                      1. Mewujudkan tamatan yang yang dapat mengamalkan agama islam secara utuh. <br>
                                      2. Membekali siswa dengan ilmu pengetahuan, ketrampilan yang bermanfaat untuk melanjutkan studi kejenjan yang lebih tinggi.
                                  </p>
                              </div>
                          </div>
                          <div class="tab-pane" role="tabpanel" id="tab-3">
                              <div class="div-tabparagraf" style="height: 200px">
                                  <p class="text-justify" style="font-size: 20px; font-weight: bold;" >Membentuk manusia muslim yang berakhalaq mulia, cakap, percaya diri sendiri, cinta tanah air dan bangsa serta berguna bagi masyarakat, agama dan negara</p>
                              </div>
                          </div>
                      </div>
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
