@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Kontak")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-kontak.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  {{-- Konten utama --}}
  <section id="body-kontak" class="body-kontak">
          @include('partials._messages')
           <div class="container kontak-container">
          <div class="row">
              <div class="col">
                  <div>
                      <div class="container-fluid">
                          <h1 class="h1-judul">Kontak</h1>
                          <form action="{{ route('kontak') }}" method="post">
                            @csrf
                            
                              <div class="form-row">
                                  <div class="col-md-6">
                                      <div id="successfail"></div>
                                  </div>
                              </div>

                              <div class="form-row">

                                <!-----col kiri ------>
                                  <div class="col-12 col-md-6 pr-3" id="message">
                                      <h2 class="h4"><i class="fas fa-envelope text-danger"></i>&nbsp;Hubungi Kami<small><small class="required-input">&nbsp;(*wajib di isi)</small></small>
                                      </h2>
                                      <div class="form-group"><label for="from-name">Nama</label><span class="required-input">*</span>
                                          <div class="input-group">
                                              <div class="input-group-prepend "><span class="input-group-text bg-light"><i class="fas fa-user text-warning"></i></span></div>
                                              <input class="form-control" type="text" name="name" required="" placeholder="Nama Lengkap" id="from-name"></div>
                                      </div>
                                      <div class="form-group"><label for="from-email">Email</label><span class="required-input">*</span>
                                          <div class="input-group">
                                              <div class="input-group-prepend"><span class="input-group-text bg-light"><i class="fas fa-envelope text-warning"></i></span></div><input class="form-control" type="email" name="email" required="" placeholder="Alamat Email" id="from-email"></div>
                                      </div>

                                      <div class="form-row">
                                          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                              <div class="form-group"><label for="from-phone">Telepon</label><span class="required-input"></span>
                                                  <div class="input-group">
                                                      <div class="input-group-prepend"><span class="input-group-text bg-light"><i class="fas fa-phone text-warning"></i></span></div><input class="form-control" type="text" name="phone" placeholder="No. Telepon" id="from-phone"></div>
                                              </div>
                                          </div>

                                          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                              <div class="form-group"><label for="from-calltime">Waktu Luang&nbsp;</label>
                                                  <div class="input-group">
                                                      <div class="input-group-prepend"><span class="input-group-text bg-light">
                                                        <i class="fas fa-clock text-warning"></i></span></div>

                                                      <select class="form-control" 
                                                      name="call_time" id="from-calltime"><optgroup label="Waktu Luang"><option value="-" selected="">-</option><option value="Pagi">Pagi</option><option value="Siang">Siang</option><option value="Sore">Sore</option></optgroup>
                                                      </select>                                                    
                                                    </div>
                                              </div>
                                          </div>

                                      </div>

                                      <div class="form-group"><label for="from-comments">Pesan / Kritik dan saran</label><span class="required-input">*</span><textarea class="form-control" rows="5" name="comments" required="" placeholder="Tulis pesan atau kritik dan saran anda"
                                              id="from-comments"></textarea></div>
                                      <div class="form-group">
                                          <div class="form-row">
                                              <div class="col"><button class="btn btn-primary btn-block" type="reset"><i class="fas fa-undo"></i> Reset</button></div>
                                              <div class="col"><button class="btn btn-primary btn-block" type="submit">Submit <i class="fa fa-chevron-circle-right"></i></button></div>
                                          </div>
                                      </div>
                                      </form>

                                      <hr class="d-flex d-md-none">
                                  </div>

                                  <!-----col kanan ------>
                                  <div class="col-12 col-md-6 pl-3">
                                      <h2 class="h4"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;Lokasi</h2>
                                      <div class="form-row">
                                          <div class="col-12">
                                              <div id="map" class="mb-5" style="width:100%;height:250px;">
                                                  <script src="{{ asset('js/lokasi.js') }}"></script>
                                                  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-1aLnFGU_fwVyTxpRuWzXQj_INKr7Aqw&callback=initMap">                                                  
                                                  </script>                                              
                                              </div>
                                          </div>
                                          <div class="col-sm-6 col-md-12 col-lg-6">
                                      
                                              <h2 class="h4"><i class="fa fa-user-circle text-danger"></i>&nbsp;Informasi</h2>
                                              <p class="m-0"><strong>Email</strong></p>
                                              <p class="e-mail lead">mi_muhammadiyahpucangan@yahoo.co.id</p>
                                              
                                              <hr class="d-sm-none d-md-block d-lg-none">
                                          </div>
                                          <div class="col-sm-6 col-md-12 col-lg-6">
                                              <h2 class="h4"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;Alamat&nbsp;</h2>
                                              <p class="m-0"><strong>MI Muhammadiyah</strong></p>
                                              <p>Gunung RT 01 RW XI, Pucangan, Kartasura, Sukoharjo</p></div>
                                              <div></div>
                                              <hr class="d-sm-none">
                                          </div>
                                      </div>
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
