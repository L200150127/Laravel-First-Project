<template>
  <div class="container">
    <div class="row mt-2 justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-md-12">

        <!-- Card Tabel User -->
        <div class="card border border-primary">

          <div class="card-header bg-primary">
            <h3 class="card-title m-0 p-2">Daftar Jadwal Pelajaran</h3>

            <!-- Tombol tambah jadwal -->
            <div class="card-tools">
              <button class="btn btn-success" @click="tambahDataModal"> 
                <i class="fas fa-plus-circle"></i> 
                <span class="text-responsive">Tambah Jadwal</span>
              </button>
            </div>
          </div>

          <!-- Tabel -->
          <div class="card-body table-responsive p-0">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-primary text-center" style="width: 60px">
                  No</th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 0)"
                    href="javascript:void(0)">Kelas 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 1)"
                    href="javascript:void(0)">Mata Pelajaran 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 2)"
                    href="javascript:void(0)">Hari 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 3)"
                    href="javascript:void(0)">Jam Mulai 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 4)"
                    href="javascript:void(0)">Jam Selesai 
                    </a>
                  </th>
                  <th scope="col" class="text-center text-primary" 
                  style="width: 120px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(dt, index) in laravelData.data">
                  <td class="tabel-cell-wide text-center">{{ index + 1 }}</td>
                  <td class="tabel-cell-wide">{{ dt.kelas.nama | capitalize }}</td>
                  <td class="tabel-cell-wide">{{ dt.mapel.nama | capitalize }}</td>
                  <td class="tabel-cell-wide">{{ dt.hari | capitalize }}</td>
                  <td class="tabel-cell-wide text-center">{{ dt.jam_mulai }}</td>
                  <td class="tabel-cell-wide text-center">{{ dt.jam_selesai }}</td>
                  <td class="tabel-cell-wide text-center">
                    <!-- Button Group Aksi -->
                    <div class="btn-group btn-group-sm d-flex ml-auto">
                      <!-- Tombol Edit -->
                      <a href="javascript:void(0)" class="btn btn-outline-info flex-fill" title="Edit" @click="editDataModal(dt)">
                        <i class="fas fa-edit"></i>
                      </a>
                      <!-- Tombol Hapus -->
                      <a href="javascript:void(0)" title="Hapus"
                      class="btn btn-outline-danger flex-fill"
                      @click="destroy(laravelData.links.self, dt.id, dt.mapel.nama, dt.kelas.nama, dt.hari)">
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
              <span slot="prev-nav"><i class="fas fa-arrow-circle-left"></i></span>
              <span slot="next-nav"><i class="fas fa-arrow-circle-right"></i></span>
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
              <span>Edit Jadwal Pelajaran</span>
            </h5>
            <h5 v-else class="modal-title" id="TambahDataLabel">
              <span>Tambah Jadwal Pelajaran</span>
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
              <!-- Input Kelas -->
              <div class="form-group">
                <label for="id-kelas">Kelas</label>
                <select name="id_kelas" v-model="form.id_kelas" 
                id="id-kelas" :class="{'custom-select': true, 'is-invalid': errors.has('id_kelas')}" data-vv-as="Kelas" 
                onfocus='this.size=5;' onblur='this.size=1;' 
                onchange='this.size=1;this.blur();' v-validate="'required'">
                  <option value="" disabled>Pilih Kelas</option>
                  <option :value="dt.id" v-for="(dt, index) in kelasData.data">
                  {{ dt.nama }}</option>
                </select>
                <!-- Feedback Error -->
                <div v-show="errors.has('id_kelas')" 
                class="invalid-feedback">
                  {{ errors.first('id_kelas') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Wali Kelas -->

              <!-- Input Mapel -->
              <div class="form-group">
                <label for="id-mapel">Mata Pelajaran</label>
                <select name="id_mapel" v-model="form.id_mapel" 
                id="id-mapel" :class="{'custom-select': true, 'is-invalid': errors.has('id_mapel')}" data-vv-as="Mata Pelajaran" 
                onfocus='this.size=5;' onblur='this.size=1;' 
                onchange='this.size=1;this.blur();' v-validate="'required'">
                  <option value="" disabled>Pilih Mata Pelajaran</option>
                  <option :value="dt.id" v-for="(dt, index) in mapelData.data">
                  {{ dt.nama }}</option>
                </select>
                <!-- Feedback Error -->
                <div v-show="errors.has('id_mapel')" 
                class="invalid-feedback">
                  {{ errors.first('id_mapel') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Wali Kelas -->

              <!-- Input Hari -->
              <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" v-model="form.hari" 
                id="hari" :class="{'custom-select': true, 'is-invalid': errors.has('hari')}" data-vv-as="Hari" 
                onfocus='this.size=5;' onblur='this.size=1;' 
                onchange='this.size=1;this.blur();' 
                v-validate="'required|alpha'">
                  <option value="" disabled>Pilih Hari</option>
                  <option value="senin">Senin</option>
                  <option value="selasa">Selasa</option>
                  <option value="rabu">Rabu</option>
                  <option value="kamis">Kamis</option>
                  <option value="jumat">Jumat</option>
                  <option value="sabtu">Sabtu</option>
                </select>
                <!-- Feedback Error -->
                <div v-show="errors.has('hari')" 
                class="invalid-feedback">
                  {{ errors.first('hari') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Wali Kelas -->

              <!-- Input Jam Mulai dan Jam Selesai -->
              <div class="form-group">
                <div class="form-row">
                  <div class="col">
                    <label for="jam-mulai">Jam Mulai</label>
                    <input type="time" class="form-control" id="jam-mulai"
                    placeholder="Jam Mulai Mata Pelajaran" name="jam_mulai"
                    :class="{'is-invalid': errors.has('jam_mulai')}" 
                    data-vv-as="Jam Mulai" v-validate="'required|date_format:HH:mm'" v-model="form.jam_mulai">
                    <!-- Feedback Error -->
                    <div v-show="errors.has('jam_mulai')" 
                    class="invalid-feedback">
                      {{ errors.first('jam_mulai') }}
                    </div><!-- /Feedback Error -->
                  </div>
                  <div class="col">
                    <label for="jam-selesai">Jam Selesai</label>
                    <input type="time" class="form-control" id="jam-selesai" 
                    name="jam_selesai" placeholder="Jam Selesai Mata Pelajaran"
                    :class="{'is-invalid': errors.has('jam_selesai')}" 
                    data-vv-as="Jam Selesai" v-validate="'required|date_format:HH:mm'" 
                    v-model="form.jam_selesai">
                    <!-- Feedback Error -->
                    <div v-show="errors.has('jam_selesai')" 
                    class="invalid-feedback">
                      {{ errors.first('jam_selesai') }}
                    </div><!-- /Feedback Error -->
                  </div>
                </div>
              </div>

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
            editMode   : true,
            laravelData: {},
            mapelData: {},
            kelasData: {},
            form       : new Form({
                id         : '',
                id_kelas   : '',
                id_mapel   : '',
                hari       : '',
                jam_mulai  : '',
                jam_selesai: '',
            }),
            sortField  : [
                ['id_kelas', 'asc'],
                ['id_mapel', 'asc'],
                ['hari', 'asc'],
                ['jam_mulai', 'asc'],
                ['jam_selesai', 'asc'],
            ],
            kolom: '',
            mode : '',
            query: '',
        }
    },
    methods: {
        tambahDataModal() {
            this.editMode = false;
            this.clearForm();
            this.openModal('crudModal', 'zoomIn');
        },
        editDataModal(dataSingle) {
            this.editMode = true;
            this.clearForm();
            this.form.fill(dataSingle);
            this.openModal('crudModal', 'zoomIn');
        },
        clearForm() {
            this.form.reset();
            this.$validator.reset();
        },
        performSubmit() {
            if (this.editMode) {
                return this.update(this.laravelData.links.self);
            } else {
                return this.create(this.laravelData.links.self);
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
        startConcurent() {
            this.$Progress.start();
            axios.all([
                this.read('jadwal'), 
                this.readList('mapel'),
                this.readList('kelas'),
                ])
                .then(axios.spread((jadwal, mapel, kelas) => {
                    this.laravelData = jadwal.data;
                    this.mapelData = mapel.data;
                    this.kelasData = kelas.data;
                    this.$Progress.finish();
                }))
                .catch( err => {
                    this.$Progress.fail();
                    console.log(err);
                });
        }
    },
    mixins: [ crudMixins, modalMixins ]
    ,
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            this.search(this.laravelData.links.cari, query);
        });
        this.startConcurent();
        this.$on('afterCrud', () => {
            this.startConcurent();
        });
    }
};

</script>
