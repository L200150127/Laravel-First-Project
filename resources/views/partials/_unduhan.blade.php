{{-- .row#unduh-file --}}
<div class="row" id="unduh-file" style="margin:0px -15px 15px -15px;">
  <div class="col">
    <div class="card" id="card-unduh-file" style="border: none;">
      
      {{-- #heading-shape --}}
      <div id="heading-shape">
        <h2 class="jdl mt-1 text-white" id="text-heading">UNDUH MATERI</h2>
      </div>{{-- /#heading-shape --}}
      <img class="card-img w-100 d-block shape-head" alt="top-border-shape" 
      src="{{ asset('img/shape.png') }}" style="height:90px;">
      
      {{-- .card-body --}}
      <div class="card-body">
        <div id="file">
          @foreach ($materi as $mt)
            <div class="row" style="margin:0px -15px 30px -15px;">
              <div class="col-3 col-sm-2 col-md-3 col-lg-3">
                <img src="{{ asset('img/fileunduh.png') }}" class="file-unduh">
              </div>
              
              <div class="col-9 col-sm-10 col-md-9 col-lg-9">
                <div>
                  <span>
                    <i class="fas fa-calendar"></i>
                    <small class="text-muted">
                      {{ 
                        $mt->created_at->formatLocalized('%A, %d %B %Y') 
                      }}
                    </small>
                  </span>
                  <span class="badge badge-pill badge-danger">
                    @if ($mt->kelas->nama)
                      {{ $mt->kelas->nama }}
                    @else
                      {{ 'Umum' }}
                    @endif
                  </span>
                  <p class="text-danger">
                    @if ($mt->mapel->nama)
                      {{ $mt->mapel->nama }}
                    @else
                      {{ 'Umum' }}
                    @endif
                    
                    <br>
                    <a href="{{ asset('storage/materi/' . $mt->path) }}"
                      title="{{ $mt->nama }}">
                      <strong>
                        {{ substr(strip_tags($mt->nama), 0, 30) }}
                        {{ strlen(strip_tags($mt->nama)) > 30 ? "..." : "" }}
                      </strong>
                    </a>
                  </p>
                </div>
              </div>                                        
            </div>
          @endforeach
          
        </div>
      </div>{{-- /.card-body --}}

    </div>
  </div>
</div>{{-- /.row#unduh-file --}}