<template>
  <div class="container">
    <div class="row mt-2 justify-content-center">
      <div class="col-md-12">

        <!-- Card Tabel Materi -->
        <div class="card border border-primary">

          <div class="card-header bg-primary">
            <h3 class="card-title m-0 p-2">Daftar Materi Pembelajaran</h3>

            <!-- Tombol tambah Materi -->
            <div class="card-tools">
              <button class="btn btn-success" @click="tambahDataModal"> 
                <i class="fas fa-plus-circle"></i> 
                <span class="text-responsive">Tambah Materi</span>
              </button>
            </div>
          </div><!-- /.card-header -->

          <!-- Tabel -->
          <div class="card-body table-responsive p-0">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-primary text-center" style="width: 60px">
                  No</th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 0)"
                    href="javascript:void(0)">Nama Materi 
                    </a>
                  </th>
                  <th scope="col" class="text-center" style="min-width: 90px;">
                    <a @click.prevent="orderBy(laravelData.links.order, 1)"
                    href="javascript:void(0)">Kelas 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 2)"
                    href="javascript:void(0)">Mata Pelajaran 
                    </a>
                  </th>
                  <th scope="col" class="text-center text-primary" 
                  style="width: 180px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(dt, index) in laravelData.data">
                  <td class="tabel-cell-wide text-center">{{ index + 1 }}</td>
                  <td class="tabel-cell-wide">{{ dt.nama }}</td>
                  <td class="tabel-cell-wide">{{ dt.kelas? dt.kelas.nama : '' }}</td>
                  <td class="tabel-cell-wide">{{ dt.mapel? dt.mapel.nama : '' }}</td>
                  <td class="tabel-cell-wide text-center">
                    <!-- Button Group Aksi -->
                    <div class="btn-group btn-group-sm d-flex ml-auto">
                      <!-- Tombol Edit -->
                      <a href="javascript:void(0)" class="btn btn-outline-info flex-fill" title="Edit" @click="editDataModal(dt)">
                        <i class="fas fa-edit"></i>
                      </a>
                      <!-- Tombol unduh -->
                      <a :href="'/storage/materi/' + dt.path" class="btn btn-outline-primary flex-fill" title="Unduh">
                        <i class="fas fa-download"></i>
                      </a>
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
              <span slot="prev-nav"><i class="fas fa-arrow-circle-left"></i></span>
              <span slot="next-nav"><i class="fas fa-arrow-circle-right"></i></span>
            </pagination>
          </div><!-- /.card-footer -->
        </div><!-- /.card -->
      </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="crudModal" tabindex="-1" role="dialog" 
    aria-labelledby="TambahDataLabel" aria-hidden="true"> 
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
          <form @submit.prevent="performSubmit">
            <div class="modal-body">
              <!-- Input Nama Materi -->
              <div class="form-group">
                <label for="id_guru">Nama</label>
                <input v-model.trim="form.nama" type="text" name="nama" 
                id="nama" placeholder="Nama Materi"
                :class=
                "{'form-control': true, 'is-invalid': errors.has('nama')}"
                v-validate=
                "{ required: true, regex: /^[a-z\d\-\'\,\/\.\s]+$/i, max: 100 }"
                data-vv-as="Nama materi">
                <!-- Feedback Error -->
                <div v-show="errors.has('nama')" class="invalid-feedback">
                  {{ errors.first('nama') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Nama -->

              <!-- Input Kelas -->
              <div class="form-group">
                <label for="id-kelas">Kelas</label>
                <select name="id_kelas" v-model="form.id_kelas" 
                id="id-kelas" :class="{'custom-select': true, 'is-invalid': errors.has('id_kelas')}"
                onfocus='this.size=5;' onblur='this.size=1;' 
                onchange='this.size=1;this.blur();'>
                  <option value="" disabled>Pilih Kelas (Opsional)</option>
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
                id="id-mapel" :class="{'custom-select': true, 'is-invalid': errors.has('id_mapel')}"
                onfocus='this.size=5;' onblur='this.size=1;' 
                onchange='this.size=1;this.blur();'>
                  <option value="" disabled>
                    Pilih Mata Pelajaran (Opsional)
                  </option>
                  <option :value="dt.id" v-for="(dt, index) in mapelData.data">
                  {{ dt.nama }}</option>
                </select>
                <!-- Feedback Error -->
                <div v-show="errors.has('id_mapel')" 
                class="invalid-feedback">
                  {{ errors.first('id_mapel') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Wali Kelas -->

              <div class="form-group">
                <label for="file">File Materi</label>
                <div class="custom-file">
                  <input type="file" name="file" id="file" lang="id"
                  :class="{'custom-file-input': true, 'is-invalid': errors.has('file')}" v-validate="{ required: !editMode, 
                  ext: ['pdf', 'doc', 'docx', 'txt', 'xls', 'xlsx', 'ppt', 'pptx'], size: 4096 }"
                  @change="updateFile" data-vv-as="File materi">
                  <label class="custom-file-label" for="file">
                    {{ fileLabel }}
                  </label>
                  <!-- Feedback Error -->
                  <div v-show="errors.has('file')" 
                  class="invalid-feedback">
                    {{ errors.first('file') }}
                  </div><!-- /Feedback Error -->
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

  </div>
</template>

<script>
// Import Mixins
import crudMixinsAxios from '../../mixins/crudMixinsAxios';
import modalMixins from '../../mixins/modalMixins';

export default {
    data() {
        return {
            editMode   : true,
            laravelData: {},
            mapelData  : {},
            kelasData  : {},
            form       : {},
            sortField  : [
                ['nama', 'asc'],
                ['id_kelas', 'asc'],
                ['id_mapel', 'asc'],
            ],
            kolom: '',
            mode : '',
            query: '',
            fileLabel: 'Pilih File',
        }
    },
    methods: {
        tambahDataModal() {
            this.editMode = false;
            this.clearForm();
            this.fileLabel = 'Pilih File';
            this.openModal('crudModal', 'zoomIn');
        },
        editDataModal(dataSingle) {
            this.editMode = true;
            this.clearForm();
            if (dataSingle.path) {
                this.fileLabel = _.truncate( dataSingle.path, {
                    'length': 50,
                });
            } else {
                this.fileLabel = 'Pilih File';
            }
            this.form = dataSingle;
            this.openModal('crudModal', 'zoomIn');
        },
        clearForm() {
            this.form = {
                id      : '',
                nama    : '',
                id_kelas: '',
                id_mapel: '',
                file    : '',
            };
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
                this.read('materi'), 
                this.readList('mapel'),
                this.readList('kelas'),
                ])
                .then(axios.spread((materi, mapel, kelas) => {
                    this.laravelData = materi.data;
                    this.mapelData = mapel.data;
                    this.kelasData = kelas.data;
                    this.$Progress.finish();
                }))
                .catch( err => {
                    this.$Progress.fail();
                    console.log(err);
                });
        },
    },
    mixins: [ crudMixinsAxios, modalMixins ]
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




