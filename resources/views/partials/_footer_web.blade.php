  {{-- Footer Website --}}
  <footer>
    {{-- .row#row-footer --}}
    <div class="row " id="row-footer">
      <div class="col-sm-6 col-md-4 footer-navigation">
        <img src="{{ asset('img/footer@2x.png') }}" class="img-bag">
      </div>

      {{-- .col-sm-6.col-md-5.col-lg-5.footer-contacts --}}
      <div class="col-sm-6 col-md-5 col-lg-5 footer-contacts">
        {{-- .footer-info --}}
        <div class="footer-info">
          <div style="margin:0px 0px 15px 0;">
            <img src="{{ asset('img/gps.svg') }}" 
            style="width:30px;margin:0 12px 0 0;">
            <p>
              <span class="new-line-span">Gunung RT 01 RW XI, Pucangan</span> Kartasura, Sukoharjo
            </p>
          </div>
          <div style="margin:0px 0px 15px 0;">
            <img src="{{ asset('img/call.svg') }}" 
            style="width:30px;margin:0 12px 0 0;">
            <p>081-393-686-626</p>
          </div>
          <div>
            <img src="{{ asset('img/mail@2x.png') }}" 
            style="width:32px;margin:0 12px 0 0;">
            <p>
              <span class="new-line-span">mi_muhammadiyahpucangan</span> 
              @yahoo.co.id
            </p>
          </div>
        </div>{{-- /.footer-info --}}
      </div>{{-- /.col-sm-6.col-md-5.col-lg-5.footer-contacts --}}

      {{-- .col-md-3.col-lg-3.footer-about --}}
      <div class="col-md-3 col-lg-3 footer-about">
        {{-- .links --}}
        <p class="links">
          <a href="/">Home</a><strong> · </strong>
          <a href="/visi-misi">Profil</a><strong> · </strong>
          <a href="{{ route('blog.semua') }}">Artikel</a><strong> · </strong>
          <a href="/album-foto">Galeri</a><strong></strong>
        </p>{{-- /.links --}}

        {{-- .social-links.social-icons --}}
        <div class="social-links social-icons" 
        style="margin:20px 0px 0 0px;">

          <a href="#" class="i-sosmed">
            <img src="{{ asset('img/ig-h.png') }}" 
            onmouseover="this.src='{{ asset('img/ig.png') }}'" 
            onmouseout="this.src='{{ asset('img/ig-h.png') }}'"
            style="margin:0px;">
          </a>

          <a href="#" class="i-sosmed">
            <img src="{{ asset('img/fb-h.png') }}" 
            onmouseover="this.src='{{ asset('img/fb.png') }}'" 
            onmouseout="this.src='{{ asset('img/fb-h.png') }}'"
            style="margin:0px;">
          </a>

          <a href="#" class="i-sosmed">
            <img src="{{ asset('img/tw-h.png') }}" 
            onmouseover="this.src='{{ asset('img/tw.png') }}'" 
            onmouseout="this.src='{{ asset('img/tw-h.png') }}'"
            style="margin:0px;">
          </a>

          <a href="#" class="i-sosmed">
            <img src="{{ asset('img/wa-h.png') }}" 
            onmouseover="this.src='{{ asset('img/wa.png') }}'" 
            onmouseout="this.src='{{ asset('img/wa-h.png') }}'"
            style="margin:0px;">
          </a>

        </div>{{-- /.social-links.social-icons --}}
      </div>{{-- /.col-md-3.col-lg-3.footer-about --}}
    </div>{{-- /.row#row-footer --}}
    
    {{-- .row.mt-4.mb-0.mx-0 --}}
    <div class="row mt-4 mb-0 mx-0">
      <div class="col" style="padding:0px;">
        <div>
          {{-- .text-center.copyright-foot.mb-0 --}}
          <p class="text-center copyright-foot mb-0">
            &copy; Copyright 2018 | MIM Pucangan
          </p>
          {{-- /.text-center.copyright-foot.mb-0 --}}
        </div>
      </div>
    </div>{{-- /.row.mt-4.mb-0.mx-0 --}}
  </footer>