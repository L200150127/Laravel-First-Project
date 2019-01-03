<section id="slide-galery">
  {{-- .container --}}
  <div class="container" id="bodyslide">
    {{-- .row#row-slide  --}}
    <div class="row" id="row-slide">
      <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" 
        data-ride="carousel" >
          {{-- .carousel-indicators --}}
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" 
            data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" 
            data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" 
            data-slide-to="2"></li>
          </ol>{{-- /.carousel-indicators --}}

          {{-- .carousel-inner --}}
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="{{ asset('img/park.jpg') }}" alt="First slide" style="width: 100%; height: 450px;">
              <div class="carousel-caption d-none d-md-block">
                <h1>First caption</h1>
                <p></p>
              </div>
            </div>

            <div class="carousel-item">
              <img class="d-block w-100" src="{{ asset('img/rails.jpg') }}" alt="Second slide" style=" width: 100%; height: 450px;">        
              <div class="carousel-caption d-none d-md-block">
                <h1>Second caption</h1>
                <p></p>
              </div>
            </div>

            <div class="carousel-item">
              <img class="d-block w-100" src="{{ asset('img/rocks.jpg') }}" alt="Third slide" style=" width: 100%; height: 450px;">        
              <div class="carousel-caption d-none d-md-block">
                <h1>Third caption</h1>
                <p></p>
              </div>
            </div>
          </div>{{-- /.carousel-inner --}}

          {{-- .carousel-control-prev --}}
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>{{-- /.carousel-control-prev --}}
          {{-- .carousel-control-next --}}
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>{{-- /.carousel-control-next --}}

        </div>
      </div>
    </div>{{-- /.row#row-slide  --}}
  </div>{{-- /.container --}}
</section>