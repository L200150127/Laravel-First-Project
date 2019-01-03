<template>
  <div class="container">
    <div class="row mt-2 justify-content-center">
        <div class="col-md-8 order-md-1 order-2">
          <div class="card border border-primary">
            <div class="card-header bg-primary">
              <h3 class="card-title mb-0">Buat Artikel</h3>
            </div>
            <div class="card-body">
              <!-- Form -->
              <form @submit.prevent="editMode? updateUser():createUser()" 
              @keydown="form.onKeydown($event)" enctype="multipart/form-data" 
              id="form-artikel">
                <!-- Input Nama User-->
                <div class="form-group">
                  <label for="judul">Judul Artikel</label>
                  <input v-model.trim="form.name" type="text" name="judul" 
                  id="judul" class="form-control" 
                  placeholder="Masukan Judul Artikel" required
                  :class="{ 'is-invalid': form.errors.has('name') }">
                  <has-error :form="form" field="name"></has-error>
                </div>

                <!-- Input Bio User-->
                <div class="form-group">
                  <label for="isi">Judul Artikel</label>
                  <textarea v-model.trim="form.bio" name="isi" id="isi" 
                  class="form-control" placeholder="Masukan Isi Artikel"
                  :class="{ 'is-invalid': form.errors.has('bio') }" 
                  rows="10"></textarea>
                  <has-error :form="form" field="bio"></has-error>
                </div>

                <div class="row justify-content-between my-2">
                  <div class="col-sm-6 col-md-4 col-lg-3 order-sm-2">
                    <button type="submit" class="btn btn-block btn-success">
                      <span>Tambahkan</span>
                    </button>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 my-1 my-sm-0">
                    <router-link :to="{ name:'artikel' }" 
                    class="btn btn-primary btn-block">
                      <span>Kembali</span>
                    </router-link>
                  </div>
                </div>
              </form>
                  
            </div>
          </div>
        </div>

        <div class="col-md-4 order-md-2 order-1">
          <div class="card border border-primary">
            <div class="card-header bg-primary">
              <h3 class="card-title mb-0">Informasi Artikel</h3>
            </div>
            <div class="card-body">

              <!-- Input Kategori Artikel -->
              <div class="form-group">
                <label for="kategori">Kategori Artikel</label>
                <select name="kategori" v-model.trim="form.type" 
                class="custom-select" id="kategori" form="form-artikel"
                :class="{ 'is-invalid': form.errors.has('type') }" required="">
                  <option value="" disabled="">Pilih Kategori</option>
                  <option value="1">Umum</option>
                  <option value="2">Pendidikan</option>
                  <option value="3">Kegiatan</option>
                  <option value="4">Berita</option>
                  <option value="5">Prestasi</option>
                </select>
                <has-error :form="form" field="type"></has-error>
              </div>

              <!-- Input File Foto Artikel -->
              <div class="form-group">
                <label for="gambar-cover">Sampul Artikel (Opsional)</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input"
                  name="gambar_cover" id="gambar-cover" lang="id" 
                  @change="updateFoto" form="form-artikel">
                  <label class="custom-file-label" for="gambar-cover">
                    {{ photoLabel }}
                  </label>
                  <has-error :form="form" field="photo"></has-error>
                </div>
              </div>

              <!-- Checkbox status artikel -->
              <div class="form-group">
                <div class="custom-control custom-checkbox text-center">
                  <input type="checkbox" class="custom-control-input" 
                  id="customCheck1" form="form-artikel">
                  <label class="custom-control-label" for="customCheck1">
                    Saya sedang membuat draft
                  </label>
                </div>
              </div>
            </div>
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
            photoLabel: 'Pilih Gambar',
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