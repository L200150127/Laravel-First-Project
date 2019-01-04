<template>
  <div class="container">
    <div class="row mt-2 justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-md-12">

        <!-- Card Tabel Guru -->
        <div class="card border border-primary">

          <div class="card-header bg-primary">
            <h3 class="card-title m-0 p-2">
              Daftar Guru 
              <span class="badge badge-info" v-if="laravelData.meta">
                {{ laravelData.meta.total }} Guru
              </span>
            </h3>
          </div><!-- /.card-header -->

          <!-- Tabel -->
          <div class="card-body table-responsive p-0">
            <table class="table table-sm table-bordered" 
            style="table-layout: fixed">
              <thead>
                <tr>
                  <th scope="col" class="text-primary" 
                  style="width: 60px">No</th>
                  <th scope="col" class="text-center text-primary" 
                  style="width: 60px">Foto</th>
                  <th scope="col" class="text-center" style="width: 170px">
                    <a @click.prevent="orderBy(laravelData.links.order, 0)"
                    href="javascript:void(0)">NIP
                    </a>
                  </th>
                  <th scope="col" class="text-center" style="width: 250px">
                    <a @click.prevent="orderBy(laravelData.links.order, 1)"
                    href="javascript:void(0)">Nama
                    </a>
                  </th>
                  <th scope="col" class="text-center" style="width: 120px">
                    <a @click.prevent="orderBy(laravelData.links.order, 2)"
                    href="javascript:void(0)">Jenis Kelamin
                    </a>
                  </th>
                  <th scope="col" class="text-center" style="width: 300px">
                    <a @click.prevent="orderBy(laravelData.links.order, 3)"
                    href="javascript:void(0)">Alamat 
                    </a>
                  </th>
                  <th scope="col" class="text-center" style="width: 200px">
                    <a @click.prevent="orderBy(laravelData.links.order, 4)"
                    href="javascript:void(0)">Jabatan 
                    </a>
                  </th>
                  <th scope="col" class="text-center" style="width: 140px">
                    <a @click.prevent="orderBy(laravelData.links.order, 5)"
                    href="javascript:void(0)">Tanggal Lahir 
                    </a>
                  </th>
                  <th scope="col" class="text-center text-primary" 
                  style="width: 120px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(dt, index) in laravelData.data">
                  <td class="tabel-cell-wide">{{ index + 1 }}</td>
                  <td class="tabel-cell-wide">
                    <img alt="foto-guru" v-if="dt.foto"
                    width="50" height="50" :src="'/storage/foto/guru/' + dt.foto" style="object-fit: cover;border-radius: 50%;">
                    <img alt="foto-guru" v-else
                    width="50" height="50" src="/svg/user.svg" 
                    style="object-fit: cover;border-radius: 50%;">
                  </td>
                  <td class="tabel-cell-wide">{{ dt.nip }}</td>
                  <td class="tabel-cell-wide">{{ dt.nama }}</td>
                  <td class="tabel-cell-wide text-center">
                    {{ dt.jenis_kelamin | gender }}
                  </td>
                  <td class="tabel-cell-wide">{{ dt.alamat }}</td>
                  <td class="tabel-cell-wide">{{ dt.jabatan }}</td>
                  <td class="tabel-cell-wide text-center">
                    {{ dt.tgl_lahir | date_id_short }}
                  </td>
                  <td class="tabel-cell-wide text-center">
                    <!-- Button Group Aksi -->
                    <div class="btn-group btn-group-sm d-flex ml-auto">
                      <!-- Tombol Edit -->
                      <router-link 
                      :to="{ name:'editguru', params: { id: dt.id } }" 
                      class="btn btn-outline-info flex-fill" title="Edit">
                        <i class="fas fa-edit"></i>
                      </router-link>
                      <!-- Tombol Hapus -->
                      <a href="javascript:void(0)" title="Hapus" 
                      class="btn btn-outline-danger flex-fill"
                      @click="destroy(laravelData.links.self, dt.id, dt.nama)">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div><!-- /.card-body -->
          <div class="card-footer">
            <pagination :data="laravelData" v-if="laravelData.data" 
            @pagination-change-page="getResults" :show-disabled="true" 
            :limit="5">
              <span slot="prev-nav">
              	<i class="fas fa-arrow-circle-left"></i>
              </span>
              <span slot="next-nav">
              	<i class="fas fa-arrow-circle-right"></i>
              </span>
            </pagination>
          </div><!-- /.card-footer -->
        </div><!-- /.card -->
      </div>
    </div>
    
    <not-found v-else></not-found>
    
  </div>
</template>

<script>
// Import Mixins
import crudMixinsAxios from '../../mixins/crudMixinsAxios';

export default {
    data() {
        return {
            laravelData: {},
            sortField  : [
                ['nip', 'asc'],
                ['nama', 'asc'],
                ['jenis_kelamin', 'asc'],
                ['alamat', 'asc'],
                ['jabatan', 'asc'],
                ['tgl_lahir', 'asc'],
            ],
            kolom: '',
            mode : '',
            query : '',
            jumlahData: '',
        }
    },
    watch: {
        // call again the method if the route changes
        '$route': 'fetchData'
    },
    methods: {
        fetchData() {
            this.read('api/guru');
        },
    },
    mixins: [ crudMixinsAxios ]
    ,
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            this.search(this.laravelData.links.cari, query);
        });
        this.read('api/guru');
        this.$on('afterCrud', () => this.read(this.laravelData.links.self));
    }
};

</script>

