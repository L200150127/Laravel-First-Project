<template>
  <div>
    
  
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning text-light">
        <div class="inner">
          <h3>150</h3>
          <p>User</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <router-link :to="{ name:'users' }" class="small-box-footer">
          Detil <i class="fas fa-arrow-circle-right"></i>
        </router-link>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box" style="background-color: turquoise">
        <div class="inner">
          <h3>53</h3>
          <p>Artikel</p>
        </div>
        <div class="icon">
          <i class="fas fa-newspaper"></i>
        </div>
        <router-link :to="{ name:'artikel' }" class="small-box-footer">
          Detil <i class="fas fa-arrow-circle-right"></i>
        </router-link>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box" style="background-color: navajowhite">
        <div class="inner">
          <h3>44</h3>
          <p>Guru</p>
        </div>
        <div class="icon">
          <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <router-link :to="{ name:'guru' }" class="small-box-footer">
          Detil <i class="fas fa-arrow-circle-right"></i>
        </router-link>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box" style="background-color: lightsalmon">
        <div class="inner">
          <h3>65</h3>
          <p>Siswa</p>
        </div>
        <div class="icon">
          <i class="fas fa-book-reader"></i>
        </div>
        <router-link :to="{ name:'siswa' }" class="small-box-footer">
          Detil <i class="fas fa-arrow-circle-right"></i>
        </router-link>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box" style="background-color: skyblue">
        <div class="inner">
          <h3>150</h3>
          <p>Kelas</p>
        </div>
        <div class="icon">
          <i class="fas fa-chalkboard"></i>
        </div>
        <router-link :to="{ name:'kelas' }" class="small-box-footer">
          Detil <i class="fas fa-arrow-circle-right"></i>
        </router-link>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box" style="background-color: lightcoral">
        <div class="inner">
          <h3>53</h3>
          <p>Materi Pendukung</p>
        </div>
        <div class="icon">
          <i class="fas fa-upload"></i>
        </div>
        <router-link :to="{ name:'materi' }" class="small-box-footer">
          Detil <i class="fas fa-arrow-circle-right"></i>
        </router-link>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box" style="background-color: gold">
        <div class="inner">
          <h3>44</h3>
          <p>Prestasi</p>
        </div>
        <div class="icon">
          <i class="fas fa-trophy"></i>
        </div>
        <router-link :to="{ name:'prestasi' }" class="small-box-footer">
          Detil <i class="fas fa-arrow-circle-right"></i>
        </router-link>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box" style="background-color: mediumaquamarine">
        <div class="inner">
          <h3>65</h3>
          <p>Alumni</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-graduate"></i>
        </div>
        <router-link :to="{ name:'alumni' }" class="small-box-footer">
          Detil <i class="fas fa-arrow-circle-right"></i>
        </router-link>
      </div>
    </div>
    <!-- ./col -->
  </div>

  <div class="row mt-3 mb-3">
    <div class="col-md-4">
      <h3>
        Agenda
        <router-link :to="{ name:'agenda' }" 
        class="btn btn-primary float-right">
          <span class="text-responsive">Detil</span> 
          <i class="fas fa-arrow-circle-right"></i>
        </router-link>
      </h3>
      <hr>
      <div class="card border border-primary" style="height: 240px">
        <div class="card-header bg-primary">
          Agenda Terbaru
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Vestibulum at eros</li>
        </ul>
      </div>
    </div>
    <div class="col-md-8">
      <h3>
        Foto Terbaru
        <router-link :to="{ name:'galeri' }" 
        class="btn btn-primary float-right">
          <span class="text-responsive">Lihat semua foto</span> 
          <i class="fas fa-arrow-circle-right"></i>
        </router-link>
      </h3>
      <hr>
      <div class="card-deck mb-3">
        <div class="card galeri-dashboard" style="max-height: 240px" >
          <div style="overflow: hidden">
            <a href="#">
              <img src="/img/rails.jpg" alt="album_image" class="card-img rounded" width="250" height="240" style="object-fit: cover;">
            </a>
          </div>
          <div class="card-img-overlay">
            <small class="m-0">
              <a href="#" class="card-text text-white">
              Nama Acara Atau Kegiatan atau Nama Foto</a>
            </small>
            <hr class="m-0">
            <small class="card-text text-white">
              Diunggah 12 jam yang lalu
            </small>
          </div>
        </div>
        <div class="card galeri-dashboard" style="max-height: 240px" >
          <div style="overflow: hidden">
            <a href="#">
              <img src="/img/rails.jpg" alt="album_image" class="card-img rounded" width="250" height="240" style="object-fit: cover;">
            </a>
          </div>
          <div class="card-img-overlay">
            <small class="m-0">
              <a href="#" class="card-text text-white">
              Nama Acara Atau Kegiatan atau Nama Foto</a>
            </small>
            <hr class="m-0">
            <small class="card-text text-white">
              Diunggah 12 jam yang lalu
            </small>
          </div>
        </div>
        <div class="card galeri-dashboard" style="max-height: 240px" >
          <div style="overflow: hidden">
            <a href="#">
              <img src="/img/rails.jpg" alt="album_image" class="card-img rounded" width="250" height="240" style="object-fit: cover;">
            </a>
          </div>
          <div class="card-img-overlay">
            <small class="m-0">
              <a href="#" class="card-text text-white">
              Nama Acara Atau Kegiatan atau Nama Foto</a>
            </small>
            <hr class="m-0">
            <small class="card-text text-white">
              Diunggah 12 jam yang lalu
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>

  </div>
</template>

<script>
export default {
    data() {
        return {
            jumlah: {},
            fotoTerbaru: {},
            events: {}
        }
    }
};

</script>
