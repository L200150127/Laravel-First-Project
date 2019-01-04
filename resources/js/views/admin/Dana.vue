<template>
  <div class="container">
    <div class="row mt-2 justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-md-12">

        <!-- Card Tabel User -->
        <div class="card border border-primary">

          <div class="card-header bg-primary">
            <h3 class="card-title m-0 p-2">
              Daftar Dana Bantuan Sekolah
            </h3>

            <!-- Tombol tambah dana -->
            <div class="card-tools">
              <button class="btn btn-success" @click="tambahDataModal"> 
                <i class="fas fa-plus-circle"></i> 
                <span class="text-responsive">Tambah Dana Bantuan</span>
              </button>
            </div>
          </div>

          <!-- Tabel -->
          <div class="card-body table-responsive p-0">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-primary text-center">No</th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 0)"
                    href="javascript:void(0)">Nama 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 1)"
                    href="javascript:void(0)">Jenis 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 2)"
                    href="javascript:void(0)">Sumber 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 3)"
                    href="javascript:void(0)">Semester 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 4)"
                    href="javascript:void(0)">Tanggal 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 5)"
                    href="javascript:void(0)">Jumlah (Rp) 
                    </a>
                  </th>
                  <th scope="col" class="text-center text-primary">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(dt, index) in laravelData.data">
                  <td class="tabel-cell-wide text-center">{{ index + 1 }}</td>
                  <td class="tabel-cell-wide">{{ dt.nama }}</td>
                  <td class="tabel-cell-wide">{{ dt.jenis }}</td>
                  <td class="tabel-cell-wide">{{ dt.sumber }}</td>
                  <td class="text-center">{{ dt.semester | semester }}</td>
                  <td class="tabel-cell-wide">
                    {{ dt.tanggal | date_id_short }}
                  </td>
                  <td class="tabel-cell-wide">{{ dt.jumlah | money }}</td>
                  <td class="tabel-cell-wide text-center">
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
              Edit Dana Bantuan</h5>
            <h5 v-else class="modal-title" id="TambahDataLabel">
              Tambah Dana Bantuan</h5>
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
              <div class="form-row mb-2 mb-2">
                <div class="col-sm-2">
                  <label for="nama" class="mt-2">Nama</label>
                </div>
                <div class="col-sm-10">
                  <input v-model.trim="form.nama" type="text" name="nama" 
                  id="nama" placeholder="Nama Dana Bantuan"
                  :class="{'form-control': true, 'is-invalid': errors.has('nama')}"
                  v-validate="{ required: true, regex: /^[a-z\d\-\s]+$/i, max:100 }"
                  data-vv-as="Nama dana bantuan">
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
                  id="jenis" placeholder="Jenis Dana Bantuan"
                  :class="{'form-control': true, 'is-invalid': errors.has('jenis')}"
                  v-validate="'required|alpha_spaces|max:20'"
                  data-vv-as="Jenis dana bantuan">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('jenis')" class="invalid-feedback">
                    {{ errors.first('jenis') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div><!-- /Input Jenis -->

              <!-- Input Sumber -->
              <div class="form-row mb-2">
                <div class="col-sm-2">
                  <label for="sumber" class="mt-2">Sumber</label>
                </div>
                <div class="col-sm-10">
                  <input v-model.trim="form.sumber" type="text" name="sumber" 
                  id="sumber" placeholder="Sumber Dana Bantuan"
                  v-validate="'alpha_spaces|max:50'"
                  :class="{'form-control': true, 'is-invalid': errors.has('sumber')}"
                  data-vv-as="Sumber dana bantuan">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('sumber')" class="invalid-feedback">
                    {{ errors.first('sumber') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div><!-- /Input Sumber -->

              <!-- Input Jumlah -->
              <div class="form-row mb-2">
                <div class="col-sm-2">
                  <label for="jumlah" class="mt-2">Jumlah</label>
                </div>
                <div class="col-sm-10">
                  <input v-model.trim="form.jumlah" type="text" name="jumlah" 
                  id="jumlah" placeholder="Jumlah dana bantuan (Rp)"
                  :class="{'form-control': true, 'is-invalid': errors.has('jumlah')}" data-vv-as="Jumlah dana bantuan (Rp)"
                  v-validate="'required|decimal:2|min_value:1000|max_value:999999999.99'">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('jumlah')" class="invalid-feedback">
                    {{ errors.first('jumlah') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div><!-- /Input Jumlah -->

              <!-- Input Semester -->
              <div class="form-row mb-2">
                <div class="col-sm-2">
                  <label for="semester" class="mt-2">Semester</label>
                </div>
                <div class="col-sm-10">
                  <input v-model.trim="form.semester" type="text" 
                  name="semester" id="semester"
                  v-validate="'required|numeric|between:1,2'"
                  placeholder="Semester (1 untuk Gasal, 2 untuk Genap)" 
                  :class="{'form-control': true, 
                  'is-invalid': errors.has('semester')}"
                  data-vv-as="Semester">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('semester')" 
                  class="invalid-feedback">
                    {{ errors.first('semester') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div><!-- /Input Semester -->

              <!-- Input Tanggal -->
              <div class="form-row mb-2">
                <!-- Please Attention the bug -->
                <div class="col-sm-2">
                  <label for="tanggal" class="mt-2">Tanggal</label>
                </div>
                <div class="col-sm-10">
                  <input v-model.trim="form.tanggal" type="date" 
                  name="tanggal" id="tanggal"
                  v-validate="{ regex: /^[a-z\d\-\\\s]+$/i }"
                  :class="{'form-control': true, 
                  'is-invalid': errors.has('tanggal')}"
                  data-vv-as="Tanggal masuk">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('tanggal')" 
                  class="invalid-feedback">
                    {{ errors.first('tanggal') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div><!-- /Input Tanggal -->
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
            form       : new Form({
                id      : '',
                nama    : '',
                jenis   : '',
                jumlah  : '',
                sumber  : '',
                semester: '',
                tanggal : '',
            }),
            sortField  : [
                ['nama', 'asc'],
                ['jenis', 'asc'],
                ['sumber', 'asc'],
                ['semester', 'asc'],
                ['tanggal', 'asc'],
                ['jumlah', 'asc'],
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
    },
    mixins: [ crudMixins, modalMixins ]
    ,
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            this.search(this.laravelData.links.cari, query);
        });
        this.read('api/dana');
        this.$on('afterCrud', () => this.read(this.laravelData.links.self));
    },
};

</script>


