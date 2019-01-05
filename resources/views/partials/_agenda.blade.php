{{-- Agenda --}}
<div class="row" id="agenda" style="margin:0px -15px 15px -15px;">
  <div class="col">
    <div class="card" id="card-agenda" style="border: none;">
      <div id="heading-shape">
        <h2 class="jdl mt-1 text-white" id="text-heading">AGENDA</h2>
      </div>
      <img class="card-img w-100 d-block shape-head" alt="top-border-shape"
      src="{{ asset('img/shape.png') }}" style="height:90px;">

      {{-- isi agenda event --}}
      <div class="card-body">
        {{-- isi agenda event --}}
        <ul class="list-group list-group-flush" style="overflow: auto">
          @foreach ($agendaBulanIni as $agenda)
            <li class="list-group-item text-primary">
              {{ $agenda->nama }} <br>
              <small class="text-muted">
                {{
                  Carbon\Carbon::parse($agenda->tgl_mulai)->formatLocalized('%A, %d %B %Y')
                }}
              </small> 
            </li>
          @endforeach
        </ul>{{--  penutup isi agenda event --}}
      </div>{{--  penutup isi agenda event --}}
    </div>
  </div>
</div>