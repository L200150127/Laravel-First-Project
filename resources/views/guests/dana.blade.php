@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Dana Bantuan")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-dana.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
  <section id="dana-tabel">
      <div class="container dana-container">

        <div class="h1-judul">
          <h1 class="text-center"><strong>Dana Bantuan</strong></h1>
          <p class="page-description text-center">MIM Pucangan</p>

        </div>

          <div class="row justify-content-end">
              <div class="col-6 col-sm-6 col-md-5 col-lg-5 offset-7" id="posisi-col">
                  <form class="search-form">
                      <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text" id="bg-icon-search"><i class="fa fa-search" data-bs-hover-animate="tada" style="font-size:20px;color:rgb(167,167,167);"></i></span></div><input class="form-control cari" type="text" placeholder="Cari Dana..."
                              id="tabel-border">
                          <div class="input-group-append"></div>
                      </div>
                  </form>
              </div>
          </div>

          <div class="row">
              <div class="col">
                  <div class="table-responsive table-bordered hasilcari" id="tabel-font">
                      <table class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th class="w-no" >NO</th>
                                  <th class="w-tgl" colspan="2">Tanggal</th>
                                  <th class="w-dban" >Dana Bantuan</th>
                                  <th class="w-nom" >Nominal</th>
                              </tr>

                              <tr class="warning no-hasil bg-light">
                                  <td colspan="5">
                                      <i class="fa fa-warning text-warning"></i>
                                      Tidak ada hasil
                                      
                                  </td>                                    
                              </tr>

                          </thead>
                          <tbody>
                            @foreach ($dana as $bantuan)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>
                                    @if ($bantuan->tanggal)
                                      {{ 
                                        Carbon\Carbon::parse($bantuan->tanggal)->formatLocalized('%A, %d %B %Y')
                                       }}
                                    @endif
                                  </td>
                                  <td>{{ ($bantuan->semester == 1)? 'Gasal' : 'Genap'  }}</td>
                                  <td>{{ $bantuan->jenis }}</td>
                                  <td>
                                    {{ 
                                      "Rp " . number_format($bantuan->jumlah,2,',','.') 
                                    }}
                                  </td>
                              </tr>
                            @endforeach
                              
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
          <div class="row justify-content-center">
              <div class="col-lg-3 col-xl-3">
                  <nav aria-label="Paginasi">
                    {!! $dana->links(); !!}
                  </nav>
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
    <script src="{{ asset('js/cari-data.js') }}"></script>
@endpush
