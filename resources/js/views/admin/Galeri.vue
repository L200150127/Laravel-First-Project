<template>
  <div class="container">
    <div class="row mt-2 justify-content-center">
      <div class="col-md-12">

        <!-- Card Container Foto foto -->
        <div class="card border border-primary">

          <div class="card-header bg-primary">
            <h3 class="card-title m-0 p-2">Foto Foto Sekolah</h3>

            <!-- Tombol tambah Foto -->
            <div class="card-tools">
              <button class="btn btn-success" @click="tambahDataModal"> 
                <i class="fas fa-plus-circle"></i> 
                <span class="text-responsive">Tambah Foto</span>
              </button>
            </div>
          </div><!-- /.card-header -->

          <div class="card-body">
            <div class="row">
              <div class="card-columns" >
                <div class="card album-container" v-for="(dt, index) in laravelData.data">
                  <div style="overflow: hidden">
                    <a :href="'/storage/foto/' + dt.path">
                      <img :src="'/storage/foto/' + dt.path" :alt="dt.nama" 
                      class="card-img-top rounded-top" width="250" height="200"
                      style="object-fit: cover;">
                    </a>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">
                      <a :href="'/storage/foto/' + dt.path">{{ dt.nama }}</a>
                    </h5>
                    <p class="card-text">{{ dt.deskripsi }}</p>
                    <p class="card-text">
                      <small class="text-muted">
                        <strong>Dibuat:</strong> 
                        {{ dt.created_at | date_id_format }}
                      </small><br>
                      <small class="text-muted">
                        <strong>Ukuran:</strong> 
                        {{ (dt.ukuran / 1000000).toFixed(2) + ' MB' }}
                      </small>
                    </p>
                    <!-- Tombol Hapus -->
                    <a href="javascript:void(0)" title="Hapus"
                    class="float-right btn btn-link text-danger"
                    @click="destroy(laravelData.links.self, dt.id, dt.nama)">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                    <!-- Tombol Edit -->
                    <a href="javascript:void(0)" title="Edit"
                    class="float-left btn btn-link text-info" 
                    @click="editDataModal(dt)">
                      <i class="fas fa-edit"></i>
                    </a>      
                  </div>
                </div>
              </div>
            </div>
          </div><!-- /.card-body -->

          <div class="card-footer">
            <pagination :data="laravelData" 
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
              <span>Edit Data Foto</span>
            </h5>
            <h5 v-else class="modal-title" id="TambahDataLabel">
              <span>Tambah Foto</span>
            </h5>
            <button type="button" class="close text-light" 
            @click="closeModal('crudModal', 'zoomOut')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- Form -->
          <form @submit.prevent="performSubmit">
            <div class="modal-body">
              <!-- Input Nama Foto -->
              <div class="form-group">
                <label for="id_guru">Nama</label>
                <input v-model.trim="form.nama" type="text" name="nama" 
                id="nama" placeholder="Nama Foto"
                :class=
                "{'form-control': true, 'is-invalid': errors.has('nama')}"
                v-validate=
                "{ required: true, regex: /^[a-z\d\-\'\,\/\.\s]+$/i, max: 100 }"
                data-vv-as="Nama foto">
                <!-- Feedback Error -->
                <div v-show="errors.has('nama')" class="invalid-feedback">
                  {{ errors.first('nama') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Nama -->
              
              <!-- Input Deskripsi Foto -->
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea v-model.trim="form.deskripsi" name="deskripsi" 
                id="deskripsi" placeholder="Deskripsi Foto"
                :class=
                "{'form-control': true, 'is-invalid': errors.has('deskripsi')}"
                v-validate=
                "{ required: true, regex: /^[a-z\d\-\'\,\.\:\/\s]+$/i, 
                max: 255 }"
                data-vv-as="Deskripsi foto"></textarea>
                <!-- Feedback Error -->
                <div v-show="errors.has('deskripsi')" 
                class="invalid-feedback">
                  {{ errors.first('deskripsi') }}
                </div><!-- /Feedback Error -->
              </div>
              
              <!-- Input file Foto -->
              <div class="form-group">
                <label for="foto">File Foto</label>
                <div class="custom-file">
                  <input type="file" name="foto" id="foto" lang="id"
                  :class="{'custom-file-input': true, 'is-invalid': errors.has('foto')}" v-validate=
                  "{ required: !editMode, image: true, size: 4096 }"
                  @change="updateFile" data-vv-as="File foto">
                  <label class="custom-file-label" for="foto">
                    {{ fileLabel }}
                  </label>
                  <!-- Feedback Error -->
                  <div v-show="errors.has('foto')" 
                  class="invalid-feedback">
                    {{ errors.first('foto') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div><!-- /Input file Foto -->

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
            form       : {},
            sortField  : [
                ['nama', 'asc'],
                ['deskripsi', 'asc'],
                ['ukuran', 'asc'],
            ],
            kolom: '',
            mode : '',
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
                id       : '',
                nama     : '',
                deskripsi: '',
                foto     : '',
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
        updateFile(e) {
            let file = e.target.files[0];
            this.fileLabel = _.truncate( file.name, {
                'length': 50,
            });
            let reader = new FileReader();
            if (file['size'] < 4096000) {
                this.form.foto = file;
            } else {
                swal({
                    type: 'error',
                    title: 'Ups...',
                    text: 'Ukuran file harus dibawah 4MB',
                });
            }
        },
    },
    mixins: [ crudMixinsAxios, modalMixins ]
    ,
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            this.search(this.laravelData.links.cari, query);
        });
        this.read('api/foto');
        this.$on('afterCrud', () => this.read(this.laravelData.links.self));
    }
};
</script>