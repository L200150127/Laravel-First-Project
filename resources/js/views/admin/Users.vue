<template>
  <div class="container">
    <div class="row mt-2 justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-md-12">

        <!-- Card Tabel User -->
        <div class="card border border-primary">

          <div class="card-header bg-primary">
            <h3 class="card-title m-0 p-2">
              Daftar User
              <span class="badge badge-info" v-if="laravelData.meta">
                {{ laravelData.meta.total }} User
              </span>
            </h3>


            <!-- Tombol tambah user -->
            <div class="card-tools">
              <button class="btn btn-success" @click="tambahDataModal"> 
                <i class="fas fa-user-plus"></i> 
                <span class="text-responsive">Tambah User</span>
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
                  <th scope="col" class="text-center text-primary" 
                  style="width: 60px">Foto</th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 0)"
                    href="javascript:void(0)">Nama 
                    </a>
                  </th>
                  <th scope="col" class="text-center" style="width: 200px">
                    <a @click.prevent="orderBy(laravelData.links.order, 1)"
                    href="javascript:void(0)">Email 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 2)"
                    href="javascript:void(0)">Otoritas 
                    </a>
                  </th>
                  <th scope="col" class="text-center">
                    <a @click.prevent="orderBy(laravelData.links.order, 3)"
                    href="javascript:void(0)">Tanggal Bergabung 
                    </a>
                  </th>
                  <th scope="col" class="text-center text-primary" 
                  style="width: 180px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(dt, index) in laravelData.data">
                  <td class="tabel-cell-wide text-center">{{ index + 1 }}</td>
                  <td class="tabel-cell-wide">
                    <img alt="foto-" v-if="dt.photo"
                    width="50" height="50" :src="'/storage/foto/user/' + dt.photo" style="object-fit: cover;border-radius: 50%;">
                    <img alt="foto-user" v-else
                    width="50" height="50" src="/svg/user.svg" 
                    style="object-fit: cover;border-radius: 50%;">
                  </td>
                  <td class="tabel-cell-wide">{{ dt.name | capitalize }}</td>
                  <td class="tabel-cell-wide">
                    {{ dt.email | capitalize(true)  }}
                  </td>
                  <td class="tabel-cell-wide">{{ dt.type | capitalize }}</td>
                  <td class="tabel-cell-wide text-center">
                    {{ dt.created_at | date_id_format }}
                  </td>
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
                      @click="destroy(laravelData.links.self, dt.id, dt.name)">
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
        </div>
        <!-- /.card -->
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="crudModal" tabindex="-1" role="dialog" 
    aria-labelledby="TambahDataLabel" aria-hidden="true" v-if="$gate.isAdmin()"> 
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border border-primary">
          <!-- Modal Header -->
          <div class="modal-header bg-primary">
            <h5 v-if="editMode" class="modal-title" id="TambahDataLabel">
              <span>Edit User</span>
            </h5>
            <h5 v-else class="modal-title" id="TambahDataLabel">
              <span>Tambah User</span>
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
                <input v-model.trim="form.name" type="text" name="name" 
                id="name" placeholder="Nama User"
                :class=
                "{'form-control': true, 'is-invalid': errors.has('name')}"
                v-validate=
                "{ required: true, regex: /^[a-z\d\-\'\,\/\.\s]+$/i, max: 100 }"
                data-vv-as="Nama User">
                <!-- Feedback Error -->
                <div v-show="errors.has('name')" class="invalid-feedback">
                  {{ errors.first('name') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Nama -->

              <!-- Input Nama Materi -->
              <div class="form-group">
                <input v-model.trim="form.email" type="email" name="email" 
                id="email" placeholder="Email User"
                :class="{'form-control': true, 'is-invalid': errors.has('email')}"
                v-validate="'required|email'" data-vv-as="Email">
                <!-- Feedback Error -->
                <div v-show="errors.has('email')" class="invalid-feedback">
                  {{ errors.first('email') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Nama -->

              <div class="form-group">
                <textarea v-model.trim="form.bio" name="bio" 
                id="bio" placeholder="Bio Singkat User"
                :class=
                "{'form-control': true, 'is-invalid': errors.has('bio')}"
                v-validate=
                "{ required: true, regex: /^[a-z\d\-\'\,\.\:\/\s]+$/i, 
                max: 255 }"
                data-vv-as="Bio Singkat User"></textarea>
                <!-- Feedback Error -->
                <div v-show="errors.has('bio')" 
                class="invalid-feedback">
                  {{ errors.first('bio') }}
                </div><!-- /Feedback Error -->
              </div>

              <!-- Input Otoritas -->
              <div class="form-group">
                <select name="type" v-model="form.type" 
                id="type" :class="{'custom-select': true, 'is-invalid': errors.has('type')}" data-vv-as="Otoritas"
                v-validate="'required|included:admin,guru'">
                  <option value="" disabled>Pilih Otoritas</option>
                  <option value="admin">Administrator</option>
                  <option value="guru">Guru</option>
                </select>
                <!-- Feedback Error -->
                <div v-show="errors.has('type')" 
                class="invalid-feedback">
                  {{ errors.first('type') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Wali Kelas -->


              <div class="form-group">
                <div class="custom-file">
                  <input type="file" name="file" id="photo" lang="id"
                  :class="{'custom-file-input': true, 'is-invalid': errors.has('photo')}" v-validate=
                  "{ image: true, size: 4096 }"
                  @change="updateFile" data-vv-as="Foto User">
                  <label class="custom-file-label" for="file" v-if="fileLabel">
                    {{ fileLabel }}
                  </label>
                  <!-- Feedback Error -->
                  <div v-show="errors.has('file')" 
                  class="invalid-feedback">
                    {{ errors.first('photo') }}
                  </div><!-- /Feedback Error -->
                </div>
              </div>

              <!-- Input Password -->
              <div class="form-group">
                <input v-model.trim="form.password" type="password" 
                name="password" id="password" 
                :placeholder="editMode ? 'Password (Kosongkan jika tidak ingin diubah)' : 'Password'"
                :class="{'form-control': true, 'is-invalid': errors.has('password')}"
                v-validate=
                "{ required: !editMode, max: 255 }" ref="password">
                <!-- Feedback Error -->
                <div v-show="errors.has('password')" class="invalid-feedback">
                  {{ errors.first('password') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input {\Password -->


              <div class="form-group">
                <input v-model="form.password_confirmation" type="password" 
                name="password_confirmation" id="password-confirm" 
                :placeholder="editMode ? 'Ulangi Password (Kosongkan jika tidak ingin diubah)' : 'Ulangi Password'" class="form-control"
                :class="{'form-control': true, 'is-invalid': errors.has('password_confirmation')}"
                v-validate=
                "{ required: !editMode, confirmed: 'password', max: 255 }"
                data-vv-as="password">
                <!-- Feedback Error -->
                <div v-show="errors.has('password_confirmation')" 
                class="invalid-feedback" >
                  {{ errors.first('password_confirmation') }}
                </div><!-- /Feedback Error -->
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
import crudMixinsAxios from '../../mixins/crudMixinsAxios';
import modalMixins from '../../mixins/modalMixins';

export default {
    data() {
        return {
            editMode: true,
            laravelData: {},
            form       : {},
            sortField  : [
                ['name', 'asc'],
                ['email', 'asc'],
                ['type', 'asc'],
                ['created_at', 'asc'],
            ],
            fileLabel: 'Pilih File',
            kolom: '',
            mode : '',
            query : '',
            jumlahData: '',
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
                id                   : '',
                name                 : '',
                email                : '',
                bio                  : '',
                type                 : '',
                photo                : '',
                password             : '',
                password_confirmation: '',
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
                this.form.photo = file;
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
        this.read('api/user');
        this.$on('afterCrud', () => this.read(this.laravelData.links.self));
    }
};

</script>
