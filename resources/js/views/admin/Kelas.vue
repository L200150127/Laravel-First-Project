<template>
  <div class="container">
    <div class="row justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-md-12">
        <!-- card Tabel Kelas -->
        <div class="card border border-primary">
          <div class="card-header bg-primary">
            <h3 class="card-title mb-0 p-2">
              Daftar Kelas
            </h3>
            <!-- Tombol tambah kelas -->
            <div class="card-tools">
              <button class="btn btn-success" @click="tambahDataModal"> 
                <i class="fas fa-plus-circle"></i> 
                <span class="text-responsive">
                  Tambah Kelas
                </span>
              </button>
            </div>
          </div>

          <!-- Tabel Kelas -->
          <div class="card-body table-responsive-md p-0">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-primary text-center" style="width: 60px">
                  No</th>
                  <th scope="col" class="text-primary text-center" style="width: auto">Nama Kelas</th>
                  <th scope="col" class="text-primary text-center" style="width: 50%">
                  Wali Kelas</th>
                  <th scope="col" class="text-center text-primary" 
                  style="width: 120px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(dt, index) in kelasData.data">
                  <td class="tabel-cell-wide text-center">{{ index + 1 }}</td>
                  <td class="tabel-cell-wide">{{ dt.nama }}</td>
                  <td class="tabel-cell-wide">{{ dt.guru ? dt.guru.nama : '' }}</td>
                  <td class="tabel-cell-wide text-center">
                    <!-- Tombol Pilihan -->
                    <div class="btn-group btn-group-sm d-flex ml-auto">
                      <a href="javascript:void(0)" title="Edit"
                      class="btn btn-outline-info flex-fill"
                      @click="editDataModal(dt)">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="javascript:void(0)" title="Hapus" 
                      class="btn btn-outline-danger flex-fill" 
                      @click="destroy(kelasData.links.self, dt.id, dt.nama)">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div><!-- /.card-body -->
          <div class="card-footer">
          </div><!-- /.card-footer -->
        </div><!-- /.card -->
      </div>
      
    </div>
    <div class="row justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-md-12">
        <!-- Card Tabel Mapel -->
        <div class="card border border-primary">
          <div class="card-header bg-primary">
            <h3 class="card-title mb-0 p-2">
              Daftar Mata Pelajaran
            </h3>
            <!-- Tombol tambah mata pelajaran -->
            <div class="card-tools">
              <button class="btn btn-success" @click="tambahDataModal(1)"> 
                <i class="fas fa-plus-circle"></i> 
                <span class="text-responsive">
                  Tambah Mata Pelajaran
                </span>
              </button>
            </div>
          </div>

          <!-- Tabel -->
          <div class="card-body table-responsive-md p-0">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-primary text-center" 
                  style="width: 60px">No</th>
                  <th scope="col" style="width: auto" class="text-center">
                    <a @click.prevent="orderBy(mapelData.links.order, 0)"
                    href="javascript:void(0)">Nama Mata Pelajaran
                    </a>
                  </th>
                  <th scope="col" class="text-primary text-center" style="width: 50%">
                  Guru Pengampu</th>
                  <th scope="col" class="text-center text-primary" 
                  style="width: 120px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(dt, index) in mapelData.data">
                  <td class="tabel-cell-wide text-center">{{ index + 1 }}</td>
                  <td class="tabel-cell-wide">{{ dt.nama }}</td>
                  <td class="tabel-cell-wide">
                      <p v-for="(guru, index) in dt.guru" class="p-0 m-0">
                        {{ guru.nama }}
                      </p>
                  </td>
                  <td class="tabel-cell-wide text-center">
                    <!-- Tombol Pilihan -->
                    <div class="btn-group btn-group-sm d-flex ml-auto">
                      <a href="javascript:void(0)" title="Edit"
                      class="btn btn-outline-info flex-fill"
                      @click="editDataModal(dt, 1)">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="javascript:void(0)" title="Hapus" 
                      class="btn btn-outline-danger flex-fill" 
                      @click="destroy(mapelData.links.self, dt.id, dt.nama)">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div><!-- /.card-body -->
          <div class="card-footer">
            <pagination :data="mapelData" v-if="mapelData.data"
            @pagination-change-page="getResults" 
            :show-disabled="true" :limit="5">
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

    <!-- Modal -->
    <div class="modal fade" id="crudModal" tabindex="-1" role="dialog" 
    aria-labelledby="TambahDataLabel" aria-hidden="true" 
    v-if="$gate.isAdmin()"> 
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border border-primary">
          <!-- Modal Header -->
          <div class="modal-header bg-primary">
            <h5 v-if="editMode" class="modal-title" id="TambahDataLabel">
              <span v-if="switchModal">Edit Kelas</span>
              <span v-else>Edit Mata Pelajaran</span>
            </h5>
            <h5 v-else class="modal-title" id="TambahDataLabel">
              <span v-if="switchModal">Tambah Kelas</span>
              <span v-else>Tambah Mata Pelajaran</span>
            </h5>
            <button type="button" class="close text-light" 
            @click="closeModal('crudModal', 'zoomOut')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- Form -->
          <form @submit.prevent="performSubmit" 
          @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <!-- Input Nama -->
              <div class="form-group">
                <label for="id_guru" v-if="switchModal">Nama Kelas</label>
                <label for="id_guru" v-else>Nama Mata Pelajaran</label>
                <input v-model.trim="form.nama" type="text" name="nama" 
                id="nama" :placeholder="placeholderText"
                :class=
                "{'form-control': true, 'is-invalid': errors.has('nama')}"
                v-validate=
                "{ required: true, regex: /^[a-z\d\-\s]+$/i, max: 50 }"
                data-vv-as="Nama Kelas">
                <!-- Feedback Error -->
                <div v-show="errors.has('nama')" class="invalid-feedback">
                  {{ errors.first('nama') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Nama -->

              <template v-if="switchModal">
              <!-- Input Wali Kelas -->
              <div class="form-group">
                <label for="wali-kelas">Wali Kelas</label>
                <select name="wali_kelas" v-model="form.wali_kelas" 
                id="wali-kelas" :class="{'custom-select': true, 'is-invalid': errors.has('wali_kelas')}" data-vv-as="Wali Kelas" 
                onfocus='this.size=5;' onblur='this.size=1;' 
                onchange='this.size=1;this.blur();' v-validate="'required'">
                  <option value="" disabled>Pilih Wali Kelas</option>
                  <option :value="dt.id" v-for="(dt, index) in guruData.data">
                  {{ dt.nama }}</option>
                </select>
                <!-- Feedback Error -->
                <div v-show="errors.has('wali_kelas')" 
                class="invalid-feedback">
                  {{ errors.first('wali_kelas') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Wali Kelas -->
              </template>
              
              <template v-else>
              <!-- Input Guru Pengampu -->
              <div class="form-group">
                <label for="id_guru">Guru Pengampu</label>
                <select name="id_guru[]" v-model="form.id_guru"
                id="guru-pengampu" :class="{'custom-select': true, 'is-invalid': errors.has('id_guru')}" multiple size="5"
                data-vv-as="Guru pengampu">
                <option value="" disabled>Pilih Guru Pengampu</option>
                  <option :value="dt.id" v-for="(dt, index) in guruData.data">
                  {{ dt.nama }}</option>
                </select>
                <!-- Feedback Error -->
                <div v-show="errors.has('id_guru')" class="invalid-feedback">
                  {{ errors.first('id_guru') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Guru Pengampu -->
              </template>

              <hr>

              <!-- Tombol Aksi -->
              <div class="row justify-content-between">
                <div class="col-sm-5">
                  <button type="button" class="btn btn-block btn-danger" 
                  @click="closeModal('crudModal', 'zoomOut')">Batal</button>
                </div>
                <div class="col-sm-5 mt-1 mt-sm-0">
                  <button v-if="editMode" type="submit" 
                  class="btn btn-success btn-block" :disabled="errors.any()">
                    Simpan Perubahan
                  </button>
                  <button v-else type="submit" 
                  class="btn btn-success btn-block" :disabled="errors.any()">
                    Tambahkan
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <not-found v-else></not-found>
  </div>
</template>

<script>
// Import Mixins
import crudMixins from '../../mixins/crudMixins';
import modalMixins from '../../mixins/modalMixins';

export default {
    data() {
        return {
            editMode       : true,
            switchModal    : true,
            placeholderText: '',
            kelasData      : {},
            mapelData      : {},
            guruData       : {},
            form           : new Form({
                id        : '',
                nama      : '',
                wali_kelas: '',
                id_guru   : [],
            }),
            sortField: [
                ['nama', 'asc'],
            ],
            kolom: '',
            mode : '',
            query: '',
        }
    },
    methods: {
        // 0 >> modal kelas ; 1 >> modal mapel
        tambahDataModal(modal=0) {
            this.editMode = false;
            this.clearForm();
            if (modal > 0) {
                this.switchModal       = false;
                this.placeholderText = 'Nama Mapel';
            } else {
                this.switchModal       = true;
                this.placeholderText = 'Nama Kelas';
            }
            this.openModal('crudModal', 'zoomIn');
        },
        editDataModal(dataSingle, modal=0) {
            this.editMode = true;
            this.clearForm();
            this.form.fill(dataSingle);
            if (modal > 0) {
                this.form.id_guru = dataSingle.guru.map(function(e) {
                    return e.id;
                });
                this.switchModal = false;
                this.placeholderText = 'Nama Mapel';
            } else {
                this.switchModal = true;
                this.placeholderText = 'Nama Kelas';
            }            
            this.openModal('crudModal', 'zoomIn');
        },
        clearForm() {
            this.form.reset();
            this.$validator.reset();
            this.guruPengampu = [];
        },
        performSubmit() {
            if (this.editMode) {
                if (this.switchModal) {
                    return this.update(this.kelasData.links.self);
                } else {
                    return this.update(this.mapelData.links.self);
                }
            } else {
                if (this.switchModal) {
                    return this.create(this.kelasData.links.self);
                } else {
                    return this.create(this.mapelData.links.self);
                }
            }
        },
        read(urlApi) {
            let apiPreffix = 'api/';
            return axios.get(apiPreffix + urlApi);
        },
        readList(urlApi) {
            let apiPreffix = 'api/list-';
            return axios.get(apiPreffix + urlApi);
        },
        orderBy(urlApi, indexField) {
            this.$Progress.start();
            this.kolom = this.sortField[indexField][0];
            this.mode = this.sortField[indexField][1];
            axios.get(`${urlApi}?
              kolom=${this.sortField[indexField][0]}&
              mode=${this.sortField[indexField][1]}`)
                .then(response => {
                    this.mapelData = response.data;
                    // Attention for bug
                    if (this.sortField[indexField][1] == 'asc') {
                        this.sortField[indexField][1] = 'desc';
                    } else {
                        this.sortField[indexField][1] = 'asc';
                    }
                    this.$Progress.finish();
                })
                .catch(() => {
                    swal(
                        'Gagal',
                        'Gagal dalam mengurutkan data',
                        'error'
                    );
                });
        },
        search(urlApi, query) {
            this.query = query;
            this.$Progress.start();
            axios.get(`${urlApi}?q=${query}`)
                .then( response => {
                    this.mapelData = response.data;
                    this.$parent.search = '';
                    this.$Progress.finish();
                })
                .catch(() => {
                    swal(
                        'Gagal',
                        'Gagal dalam melakukan pencarian',
                        'error'
                    );
                });
        },
        getResults(page = 1) {
            if (page == this.mapelData.meta.current_page) {
                return;
            }
            this.$Progress.start();
            let kolom = (this.kolom) ? '?kolom=' + this.kolom : '';
            let mode = (this.mode) ? '&mode=' + this.mode : '';
            let query = (this.query) ? '?q=' + this.query : '';
            let halaman = (this.kolom || this.query) ? '&page=' + page : '?page=' + page;
            if (this.query) {
                axios.get(this.mapelData.meta.path + query + halaman)
                    .then( response => {
                        this.mapelData = response.data;
                        this.$Progress.finish();
                    });
            } else {
                axios.get(this.mapelData.meta.path + kolom + mode + halaman)
                    .then( response => {
                        this.mapelData = response.data;
                        this.$Progress.finish();
                    });
            }
            
        },
        startConcurent() {
            this.$Progress.start();
            axios.all([
                this.read('kelas'), 
                this.read('mapel'),
                this.readList('guru'),
                ])
                .then(axios.spread((kelas, mapel, guru) => {
                    this.mapelData = mapel.data;
                    this.kelasData = kelas.data;
                    this.guruData  = guru.data;
                    this.$Progress.finish();
                }))
                .catch( err => {
                    this.$Progress.fail();
                    console.log(err);
                });
        },
    },
    mixins: [ crudMixins, modalMixins ]
    ,
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            this.search(this.mapelData.links.cari, query);
        });
        this.startConcurent();
        this.$on('afterCrud', () => {
            this.startConcurent();
        });
    }
};

</script>

