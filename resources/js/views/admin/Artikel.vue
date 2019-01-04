<template>
  <div class="container">
    <div class="row mt-2 justify-content-center">
      <div class="col-md-12">

        <!-- Card Tabel artikel -->
        <div class="card border border-primary">

          <div class="card-header bg-primary">
            <h3 class="card-title m-0 p-2">
              Daftar Artikel 
              <span class="badge badge-info" v-if="laravelData.meta">
                {{ laravelData.meta.total }} Artikel
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
                  style="width: 110px">Gambar Sampul</th>
                  <th scope="col" class="text-center" style="width: 300px">
                    <a @click.prevent="orderBy(laravelData.links.order, 0)"
                    href="javascript:void(0)">Judul 
                    </a>
                  </th>
                  <th scope="col" class="text-center" style="width: 250px">
                    <a @click.prevent="orderBy(laravelData.links.order, 1)"
                    href="javascript:void(0)">Tanggal Dibuat 
                    </a>
                  </th>
                  <th scope="col" class="text-center text-primary" 
                  style="width: 120px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(dt, index) in laravelData.data">
                  <td class="tabel-cell-wide">{{ index + 1 }}</td>
                  <td class="tabel-cell-wide text-center">
                    <img alt="gambar-sampul-artikel" v-if="dt.gambar_cover"
                    width="100" height="50" :src="'/storage/foto/artikel/' + dt.gambar_cover" style="object-fit: cover;" 
                    class="rounded">
                    <img alt="gambar-sampul-artikel" v-else
                    width="100" height="50" 
                    src="/storage/default/images/cover_default.png" 
                    style="object-fit: cover;" class="rounded">
                  </td>
                  <td class="tabel-cell-wide">{{ dt.judul }}</td>
                  <td class="tabel-cell-wide text-center">{{ dt.created_at | date_id_format }}</td>
                  <td class="tabel-cell-wide text-center">
                    <!-- Button Group Aksi -->
                    <div class="btn-group btn-group-sm d-flex ml-auto">
                      <!-- Tombol Edit -->
                      <router-link 
                      :to="{ name:'editartikel', params: { id: dt.id } }" 
                      class="btn btn-outline-info flex-fill" title="Edit">
                        <i class="fas fa-edit"></i>
                      </router-link>
                      <!-- Tombol Hapus -->
                      <a href="javascript:void(0)" title="Hapus" 
                      class="btn btn-outline-danger flex-fill"
                      @click="destroy(laravelData.links.self, dt.id, dt.judul)">
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
                ['judul', 'asc'],
                ['created_at', 'asc'],
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
            this.read('api/artikel');
        },
    },
    mixins: [ crudMixinsAxios ]
    ,
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            this.search(this.laravelData.links.cari, query);
        });
        this.read('api/artikel');
        this.$on('afterCrud', () => this.read(this.laravelData.links.self));
    }
};

</script>
