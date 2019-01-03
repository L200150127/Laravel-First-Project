<template>
  <div class="container">
    <div class="row mt-2 justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-md-12">

        <!-- Card Tabel User -->
        <div class="card border border-primary">
          <div class="card-header bg-primary">
            <h3 class="card-title mb-0 p-0">Daftar Guru</h3>

          </div>

          <!-- Tabel -->
          <div class="card-body table-responsive p-0">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col" class="text-center">Foto</th>
                  <th scope="col" class="text-center">NIP</th>
                  <th scope="col" class="text-center">Nama</th>
                  <th scope="col" class="text-center">Jenis Kelamin</th>
                  <th scope="col" class="text-center">Alamat</th>
                  <th scope="col" class="text-center">Jabatan</th>
                  <th scope="col" class="text-center">Tanggal Lahir</th>
                  <th scope="col" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="kosong">
                  <td colspan="6" class="text-center">Tidak Ada Data</td>
                </tr>
                <tr v-for="(user, index) in users.data">
                  <td class="tabel-cell-wide">{{ index + 1 }}</td>
                  <td >
                    <img alt="foto-guru" 
                    width="50" height="50" src="/img/avatar-so.png" 
                    style="object-fit: cover;border-radius: 50%;">
                  </td>
                  <td class="tabel-cell-wide">1234567891234567</td>
                  <td class="tabel-cell-wide">Muhammad Luqman Hakim S.Pd.</td>
                  <td class="tabel-cell-wide">Laki-laki</td>
                  <td class="tabel-cell-wide">Wonosari Sukoharjo</td>
                  <td class="tabel-cell-wide">Bendahara Sekolah</td>
                  <td class="tabel-cell-wide">12/09/1995</td>
                  <td class="tabel-cell-wide">
                    <!-- Tombol Pilihan -->
                    <div class="btn-group btn-group-sm d-flex ml-auto">
                      <a href="javascript:void(0)" class="btn btn-outline-info flex-fill"
                      title="Edit" data-toggle="modal" data-target="#crudModal"
                      @click="editDataModal(user)">
                        <i class="fas fa-user-edit"></i>
                      </a>
                      <a href="javascript:void(0)" 
                      class="btn btn-outline-danger flex-fill"
                      title="Hapus" @click="deleteUser(user.id, user.name)">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    
    <not-found v-else></not-found>

    <!-- Modal -->
    <div class="modal fade" id="crudModal" tabindex="-1" role="dialog" 
    aria-labelledby="TambahDataLabel" aria-hidden="true" 
    v-if="$gate.isAdmin()">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 v-if="editMode" class="modal-title" id="TambahDataLabel">
              Edit User</h5>
            <h5 v-else class="modal-title" id="TambahDataLabel">
              Tambah User</h5>
            <button type="button" class="close" data-dismiss="modal" 
            aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- Form -->
          <form @submit.prevent="editMode? updateUser():createUser()" 
          @keydown="form.onKeydown($event)" enctype="multipart/form-data">
            <div class="modal-body">

              <!-- Input Nama User-->
              <div class="form-group">
                <input v-model.trim="form.name" type="text" name="name" id="name" 
                class="form-control" placeholder="Username" required
                :class="{ 'is-invalid': form.errors.has('name') }">
                <has-error :form="form" field="name"></has-error>
              </div>

              <!-- Input Email User-->
              <div class="form-group">
                <input v-model="form.email" type="email" name="email" 
                id="email" :class="{ 'is-invalid': form.errors.has('email') }"
                class="form-control" placeholder="Alamat Email" required>
                <has-error :form="form" field="email"></has-error>
              </div>

              <!-- Input Bio User-->
              <div class="form-group">
                <textarea v-model.trim="form.bio" name="bio" id="bio" 
                class="form-control" placeholder="Bio Singkat (Opsional)"
                :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                <has-error :form="form" field="bio"></has-error>
              </div>

              <!-- Input File Foto User-->
              <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input"
                  name="photo" id="photo" lang="id" @change="updateFoto">
                  <label class="custom-file-label" for="photo">
                    {{ photoLabel }}
                  </label>
                  <has-error :form="form" field="photo"></has-error>
                </div>
              </div>

              <!-- Input Hak Akses-->
              <div class="form-group">
                <select name="type" v-model.trim="form.type" class="custom-select" 
                :class="{ 'is-invalid': form.errors.has('type') }" id="type">
                  <option value="" disabled="">Pilih Hak Akses</option>
                  <option value="admin">Administrator</option>
                  <option value="guru">Guru</option>
                </select>
                <has-error :form="form" field="type"></has-error>
              </div>

              <!-- Input Password-->
              <div class="form-group">
                <input v-model="form.password" type="password" name="password" 
                class="form-control" id="password" :required="!editMode"
                :class="{ 'is-invalid': form.errors.has('password') }"
                :placeholder="editMode ? 'Password (Kosongkan jika tidak ingin diubah)' : 'Password'"> 
                <has-error :form="form" field="password"></has-error>
              </div>
              <div class="form-group">
                <input v-model="form.password_confirmation" type="password" 
                name="password_confirmation" id="password-confirm" 
                :placeholder="editMode ? 'Ulangi Password (Kosongkan jika tidak ingin diubah)' : 'Password'" class="form-control"
                :class="{ 'is-invalid': form.errors.has('password') }" 
                :required="!editMode">
                <has-error :form="form" field="password_confirmation">
                </has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" 
              data-dismiss="modal">Batal</button>
              <button v-if="editMode" type="submit" class="btn btn-success">
                Simpan Perubahan</button>
              <button v-else type="submit" class="btn btn-success">
                Tambahkan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    

  </div>
</template>

<script>
export default {
    data() {
        return {
            editMode: true,
            kosong: false,
            users: {},
            form: new Form({
                id: '',
                name: '',
                email: '',
                password: '',
                type: '',
                bio: '',
                photo: ''
            }),
            photoLabel: 'Pilih Foto (Opsional)',
            page: 'Manajemen User'
        }
    },
    methods: {
        tambahDataModal() {
            this.editMode = false;
            this.photoLabel = 'Pilih Foto (Opsional)'
            this.form.reset();
            $('#crudModal').modal('show');
        },
        editDataModal(user) {
            this.editMode = true;
            this.form.reset();
            if (user.photo) {
                this.photoLabel = user.photo;
            } else {
                this.photoLabel = 'Pilih Foto (Opsional)';
            }
            this.form.fill(user);
            $('#crudModal').modal('show');
        },
        createUser() {
            this.$Progress.start();
            // Submit form melualu PUT request
            this.form.post('api/user').then(({ data }) => {
                this.$emit('afterCrud');
                $('#crudModal').modal('hide');
                toast({
                    type: 'success',
                    title: 'User baru berhasil ditambahkan'
                });
                this.$Progress.finish();
                this.form.reset();
            }).catch((error) => {
                this.$Progress.fail();
                toast({
                    type: 'error',
                    title: 'User baru gagal ditambahkan'
                });
                console.log(error);
            });
        },
        loadUser() {
            if (this.$gate.isAdmin()) {
                this.$Progress.start();
                axios.get('api/user').then(({ data }) => {
                    this.users = data;
                    this.isKosong();
                    this.$Progress.finish();
                }).catch((error) => {
                    this.$Progress.fail();
                    console.log(error);
                });
            }
        },
        updateUser(id) {
            this.$Progress.start();
            // Submit form melualu POST request
            this.form.put('api/user/'+this.form.id).then(({ data }) => {
                this.$emit('afterCrud');
                $('#crudModal').modal('hide');
                toast({
                    type: 'success',
                    title: 'Data user berhasil diupdate'
                });
                this.$Progress.finish();
                this.form.reset();
                this.photoLabel = 'Pilih Foto (Opsional)';
            }).catch((error) => {
                this.$Progress.fail();
                toast({
                    type: 'error',
                    title: 'Data user gagal diupdate'
                });
                console.log(error);
            });
        },
        updateFoto(e) {
            let file = e.target.files[0];
            this.photoLabel = file.name;
            let reader = new FileReader();
            if (file['size'] < 2111775) {
                reader.onloadend = (file) => {
                  this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            } else {
                swal({
                    type: 'error',
                    title: 'Ups...',
                    text: 'Ukuran gambar terlalu besar, ukuran gambar harus dibawah 2MB',
                });
            }
        },
        deleteUser(id, nama) {
            swal({
                title: 'Apakah anda yakin?',
                text: 'Anda akan menghapus user yang bernama ' + 
                       Vue.filter('capitalize')(nama),
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#dc3545',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    // Jika ya, kirim request ke server
                    this.form.delete('api/user/' + id)
                    .then(() => {
                        swal(
                            'Berhasil!',
                            'User berhasil dihapus.',
                            'success'
                        )
                        this.$emit('afterCrud');
                    }).catch(() => {
                        swal(
                            'Gagal',
                            'Gagal menghapus user',
                            'error'
                        );
                    });
                }
            })
        },
        isKosong() {
            if (_.size(this.users) >= 1) {
                return this.kosong = false;
            }
            return this.kosong = true;
        },
    },
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            if (!query) { return false }
            this.$Progress.start();
            axios.get('api/cari/user?q=' + query)
            .then(( data ) => {
              this.users = data.data;
              this.$Progress.finish();
            })
            .catch(() => {
                swal(
                    'Gagal',
                    'Gagal menghapus melakukan pencarian',
                    'error'
                );
            });
        });
        this.loadUser();
        this.$on('afterCrud', () => this.loadUser());
    }
};

</script>

