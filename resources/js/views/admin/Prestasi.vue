<template>
  <div class="container">
    <div class="row mt-2 justify-content-center">
      <div class="col-md-12">

        <!-- Card Tabel Prestasi -->
        <div class="card border border-primary">

          <div class="card-header bg-primary">
            <h3 class="card-title m-0 p-2">Daftar Prestasi Sekolah</h3>

            <!-- Tombol Tambah Prestasi -->
            <div class="card-tools">
              <button class="btn btn-success" @click="tambahDataModal"> 
                <i class="fas fa-plus-circle"></i> 
                <span class="text-responsive">Tambah Prestasi</span>
              </button>
            </div>

          </div>

          <!-- Tabel -->
          <div class="card-body table-responsive p-0">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="text-primary">No</th>
                  <th scope="col">
                    <a @click.prevent="orderBy(laravelData.links.order, 0)"
                    href="javascript:void(0)">Kompetisi / Lomba 
                    </a>
                  </th>
                  <th scope="col" class="text-primary">Jenis</th>
                  <th scope="col" class="text-primary">Tingkat</th>
                  <th scope="col">
                    <a @click.prevent="orderBy(laravelData.links.order, 1)"
                    href="javascript:void(0)">Tahun
                    </a>
                  </th>
                  <th scope="col" class="text-primary">Pencapaian</th>
                  <th scope="col" class="text-center text-primary">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(dt, index) in laravelData.data">
                  <td>{{ index + 1 }}</td>
                  <td>{{ dt.nama }}</td>
                  <td>{{ dt.jenis }}</td>
                  <td>{{ dt.tingkat }}</td>
                  <td>{{ dt.tahun }}</td>
                  <td>{{ dt.pencapaian }}</td>
                  <td>
                    <!-- Button Group Aksi -->
                    <div class="btn-group btn-group-sm d-flex ml-auto">
                      <!-- Tombol Edit -->
                      <a href="javascript:void(0)" title="Edit"
                      class="btn btn-outline-info flex-fill"  
                      @click="editDataModal(dt)">
                        <i class="fas fa-edit"></i>
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
            <pagination :data="laravelData" 
            @pagination-change-page="getResults" 
            :limit="3" :show-disabled="true">
              <span slot="prev-nav">
                <i class="fas fa-arrow-circle-left"></i>
              </span>
              <span slot="next-nav">
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </pagination>
          </div>
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
              Edit Prestasi</h5>
            <h5 v-else class="modal-title" id="TambahDataLabel">
              Tambah Prestasi</h5>
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
              <div class="form-row mb-2">
                <div class="col-sm-2">
                  <label for="nama" class="mt-2">Nama</label>
                </div>
                <div class="col-sm-10">
                  <input v-model.trim="form.nama" type="text" name="nama" 
                  id="nama" placeholder="Nama kompetisi atau lomba"
                  :class="{'form-control': true, 'is-invalid': errors.has('nama')}"
                  v-validate="{ regex: /^[a-z\d\-\s]+$/i, max: 100 }"
                  data-vv-as="Nama kompetisi atau lomba">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('nama')" class="invalid-feedback">
                    {{ errors.first('nama') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div><!-- /Input Nama -->

              <!-- Input Jenis -->
              <div class="form-row mb-2">
                <div class="col-sm-2">
                  <label for="jenis" class="mt-2">Jenis</label>
                </div>
                <div class="col-sm-10">
                  <input v-model.trim="form.jenis" type="text" name="jenis" 
                  id="jenis" placeholder="Jenis kompetisi atau lomba"
                  :class="{'form-control': true, 'is-invalid': errors.has('jenis')}"
                  v-validate="'required|alpha_spaces|max:20'"
                  data-vv-as="Jenis kompetisi atau lomba">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('jenis')" class="invalid-feedback">
                    {{ errors.first('jenis') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div><!-- /Input Jenis -->

              <!-- Input Tingkat -->
              <div class="form-row mb-2">
                <div class="col-sm-2">
                  <label for="tingkat" class="mt-2">Tingkat</label>
                </div>
                <div class="col-sm-10">
                  <input v-model.trim="form.tingkat" type="text" name="tingkat"
                  id="tingkat" placeholder="Tingkat kompetisi atau lomba"
                  v-validate="'required|alpha_spaces|max:20'"
                  :class="{'form-control': true, 'is-invalid': errors.has('tingkat')}"
                  data-vv-as="Tingkat kompetisi atau lomba">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('tingkat')" class="invalid-feedback">
                    {{ errors.first('tingkat') }}
                  </div><!-- /Feedback Error -->
                </div>
                
              </div><!-- /Input Tingkat -->

              <!-- Input Tahun -->
              <div class="form-row mb-2">
                <div class="col-sm-2">
                  <label for="tahun" class="mt-2">Tahun</label>
                </div>
                <div class="col-sm-10">
                  <input v-model.trim="form.tahun" type="text" name="tahun" 
                  id="tahun" placeholder="Tahun kompetisi atau lomba (YYYY)"
                  :class="{'form-control': true, 'is-invalid': errors.has('tahun')}" data-vv-as="Tahun kompetisi atau lomba"
                  v-validate="'required|date_format:YYYY|before:tahunDepan'"
                  data-vv-delay="650">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('tahun')" class="invalid-feedback">
                    {{ errors.first('tahun') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div><!-- /Input Tahun -->

              <!-- Input Pencapaian -->
              <div class="form-row mb-2">
                <div class="col-sm-2">
                  <label for="pencapaian" class="mt-2">Prestasi</label>
                </div>
                <div class="col-sm-10">
                  <input v-model.trim="form.pencapaian" type="text" 
                  name="pencapaian" id="pencapaian"
                  v-validate="{ regex: /^[a-z\d\s\\/\\(\\)\\,\\']+$/i, max:100 }"
                  placeholder="Pencapaian Hasil" :class="{'form-control': true, 
                  'is-invalid': errors.has('pencapaian')}"
                  data-vv-as="Pencapaian hasil">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('pencapaian')" 
                  class="invalid-feedback">
                    {{ errors.first('pencapaian') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div><!-- /Input Pencapaian -->
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
          <input type="hidden" name="tahun_depan" :value="tahunDepan" 
          ref="tahunDepan" data-vv-as="tahun depan">
        </div>
      </div>
    </div>
    

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
            tahunDepan : '',
            laravelData: {},
            form       : new Form({
                id        : '',
                nama      : '',
                jenis     : '',
                tingkat   : '',
                tahun     : '',
                pencapaian: '',
            }),
            sortField  : [
                ['nama', 'asc'],
                ['tahun', 'asc']
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
        getResults(page = 1) {
            if (page == this.laravelData.meta.current_page) {
                return;
            }
            this.$Progress.start();
            let kolom = (this.kolom) ? '?kolom=' + this.kolom : '';
            let mode = (this.mode) ? '&mode=' + this.mode : '';
            let query = (this.query) ? '?q=' + this.query : '';
            let halaman = (this.kolom || this.query) ? '&page=' + page : '?page=' + page;
            if (this.query) {
                axios.get(this.laravelData.meta.path + query + halaman)
                    .then( response => {
                        this.laravelData = response.data;
                        this.tahunDepan = this.getYear(response.data.links.tahunDepan);
                        this.$Progress.finish();
                    });
            } else {
                axios.get(this.laravelData.meta.path + kolom + mode + halaman)
                    .then( response => {
                        this.laravelData = response.data;
                        this.tahunDepan = this.getYear(response.data.links.tahunDepan);
                        this.$Progress.finish();
                    });
            }
        },
        performSubmit() {
            if (this.editMode) {
                return this.update(this.laravelData.links.self);
            } else {
                return this.create(this.laravelData.links.self);
            }
        },
        getYear(date) {
            let d = new Date(date);
            return d.getFullYear();
        },
        read(urlApi) {
            this.$Progress.start();
            axios.get(urlApi)
                .then(response => {
                    this.laravelData = response.data;
                    this.tahunDepan = this.getYear(response.data.links.tahunDepan);
                    this.$Progress.finish();
                })
                .catch(err => {
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
            this.search(this.laravelData.links.cari, query);
        });
        this.read('api/prestasi');
        this.$on('afterCrud', () => this.read(this.laravelData.links.self));
    },
};

</script>


