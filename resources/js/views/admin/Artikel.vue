<template>
  <div class="container">
    <div class="row mt-2 justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-md-12">
        <!-- Card Tabel artikel -->
        <div class="card border border-primary">
          <div class="card-header bg-primary">
            <h3 class="card-title">Daftar Artikel</h3>
            <!-- Tombol tambah artikel -->
            <div class="card-tools">
              <router-link :to="{ name:'tambahartikel' }" class="btn btn-success">
                <i class="fas fa-plus-circle"></i>
                <span class="text-responsive">Buat Artikel</span>
              </router-link>
            </div>
          </div>
          <!-- Tabel -->
          <div class="card-body table-responsive p-0">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="text-center">No</th>
                  <th scope="col" class="text-center">Gambar Sampul</th>
                  <th scope="col">Judul</th>
                  <th scope="col">Tanggal Dibuat</th>
                  <th scope="col">Kategori</th>
                  <th scope="col" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="kosong">
                  <td colspan="6" class="text-center">Tidak Ada Data</td>
                </tr>
                <tr v-for="(user, index) in users.data" :key="user.id">
                  <td class="tabel-cell-wide">{{ index + 1 }}</td>
                  <td class="tabel-cell-wide">
                    <img alt="gambar-sampul-artikel"
                    width="100" height="50" src="/img/rails.jpg"
                    style="object-fit: cover;" class="rounded">
                  </td>
                  <td>Melakukan Yang Benar adalah Suatu Hal Yang Benar</td>
                  <td>12/12/2018 12:00 WIB</td>
                  <td>Pendidikan</td>
                  <td>
                    <!-- Tombol Pilihan -->
                    <div class="btn-group btn-group-sm d-flex ml-auto">
                      <a href="javascript:void(0)" class="btn btn-outline-info flex-fill" title="Edit" data-toggle="modal" 
                      data-target="#crudModal"
                      @click="editDataModal(user)">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="javascript:void(0)"
                        class="btn btn-outline-danger flex-fill" title="Hapus"
                        @click="deleteUser(user.id, user.name)">
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
    <div class="card-deck">
        <div class="card border border-primary">
          <div class="card-header bg-primary">
              Daftar Kategori
          </div>
          <form @submit.prevent="editMode? updateUser():createUser()" @keydown="form.onKeydown($event)" id="form-kategori">
              <div class="input-group ">
                <input type="text" name="nama" v-model.trim="form.name" 
                class="form-control" placeholder="Buat Kategori Baru">
                <div class="input-group-append">
                  <button class="btn btn-success" type="submit" 
                  id="submit">
                    <i class="fas fa-plus-circle"></i>
                    <span class="text-responsive">Tambahkan</span>
                  </button>
                </div>
              </div>
          </form>
          <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Cras justo odio 
                <span class="badge badge-pill badge-primary">5</span>
                <a href="javascript:void(0)"
                class="btn btn-link text-danger float-right p-0" 
                title="Hapus "@click="deleteUser(user.id, user.name)">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </li>
              <li class="list-group-item">
                Dapibus ac facilisis in
                <span class="badge badge-pill badge-primary">10</span>
                <a href="javascript:void(0)"
                class="btn btn-link text-danger float-right p-0" 
                title="Hapus "@click="deleteUser(user.id, user.name)">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </li>
              <li class="list-group-item">
                Vestibulum at eros
                <a href="javascript:void(0)"
                class="btn btn-link text-danger float-right p-0" 
                title="Hapus "@click="deleteUser(user.id, user.name)">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </li>
          </ul>
        </div>
        <div class="card border border-primary">
            <div class="card-header bg-primary">
                Daftar Artikel Draft
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <a href="#" class="btn-link text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, ipsum.</a>
                  <a href="javascript:void(0)"
                  class="btn btn-link text-danger float-right" 
                  title="Hapus "@click="deleteUser(user.id, user.name)">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </li>
            </ul>
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
