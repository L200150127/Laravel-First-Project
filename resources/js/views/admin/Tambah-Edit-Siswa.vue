<template>
  <div class="container">
    <div class="row mt-2 justify-content-center">
        <div class="col-md-8 order-md-1 order-2">
          <div class="card border border-primary">
            <div class="card-header bg-primary">
              <h3 class="card-title mb-0">Tambah Siswa</h3>
            </div>
            <div class="card-body">
              <!-- Form -->
              <form @submit.prevent="editMode? updateUser():createUser()" 
              @keydown="form.onKeydown($event)" enctype="multipart/form-data" 
              id="form-siswa">

                <!-- Input NIS -->
                <div class="form-group">
                  <label for="judul">NIS</label>
                  <input v-model.trim="form.name" type="text" name="nis" 
                  id="nis" class="form-control" maxlength="20" 
                  placeholder="Masukan NIS Siswa"
                  :class="{ 'is-invalid': form.errors.has('nis') }">
                  <has-error :form="form" field="nis"></has-error>
                </div>

                <!-- Input Nama -->
                <div class="form-group">
                  <label for="judul">NISN</label>
                  <input v-model.trim="form.name" type="text" name="nisn" 
                  id="nisn" class="form-control" maxlength="20" 
                  placeholder="Masukan NISN Siswa (Opsional)"
                  :class="{ 'is-invalid': form.errors.has('nisn') }">
                  <has-error :form="form" field="nisn"></has-error>
                </div>

                <!-- Input Nama -->
                <div class="form-group">
                  <label for="judul">Nama</label>
                  <input v-model.trim="form.name" type="text" name="nama" 
                  id="nama" class="form-control" 
                  placeholder="Masukan Nama Siswa" required
                  :class="{ 'is-invalid': form.errors.has('name') }">
                  <has-error :form="form" field="nama"></has-error>
                </div>

                <!-- Radio jenis kelamin -->
                <label for="jkl">Jenis Kelamin</label>
                <div class="form-group">
                  <div class="custom-control custom-radio 
                  custom-control-inline">
                    <input type="radio" id="jkl" name="jenis_kelamin" 
                    class="custom-control-input">
                    <label class="custom-control-label" for="jkl">
                    Laki-laki</label>
                  </div>
                  <div class="custom-control custom-radio 
                  custom-control-inline">
                    <input type="radio" id="jkp" name="jenis_kelamin" 
                    class="custom-control-input">
                    <label class="custom-control-label" for="jkp">
                    Perempuan</label>
                  </div>
                </div>

                <!-- Alamat-->
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea v-model.trim="form.alamat" name="alamat" 
                  id="alamat" class="form-control" 
                  placeholder="Masukan Alamat Siswa"
                  :class="{ 'is-invalid': form.errors.has('alamat') }">
                  </textarea>
                  <has-error :form="form" field="alamat"></has-error>
                </div>

                <!-- Input Tanggal Lahir -->
                <div class="form-group">
                  <label for="tanggal-lahir">Tanggal Lahir</label>
                  <input v-model.trim="form.tgl_lahir" type="date" 
                  name="tgl_lahir" id="tgl_lahir" class="form-control" 
                  placeholder="Masukan Tanggal Lahir Guru" required
                  :class="{ 'is-invalid': form.errors.has('tgl_lahir') }">
                  <has-error :form="form" field="tgl_lahir"></has-error>
                </div>

                <!-- Radion Status Siswa -->
                <label for="siswa-aktif">Status Siswa</label>
                <div class="form-group">
                  <div class="custom-control custom-radio 
                  custom-control-inline">
                    <input type="radio" id="siswa-aktif" name="status" 
                    class="custom-control-input">
                    <label class="custom-control-label" for="siswa-aktif">
                    Siswa Aktif</label>
                  </div>
                  <div class="custom-control custom-radio 
                  custom-control-inline">
                    <input type="radio" id="alumni" name="status" 
                    class="custom-control-input">
                    <label class="custom-control-label" for="alumni">
                    Alumni</label>
                  </div>
                </div>

                <!-- Input Tahun Masuk dan Tahun Lulus -->
                <div class="form-group">
                  <div class="form-row">
                    <div class="col">
                      <label for="tahun-masuk">Tahun Masuk</label>
                      <input type="text" class="form-control" id="tahun-masuk"
                      placeholder="Tahun Masuk" name="tahun_masuk">
                    </div>
                    <div class="col">
                      <label for="tahun-lulus">Tahun Lulus</label>
                      <input type="text" class="form-control" id="tahun-lulus" 
                      placeholder="Tahun Lulus" name="tahun_lulus">
                    </div>
                  </div>
                </div>

              <!-- Input File Foto Siswa -->
              <div class="form-group">
                <label for="gambar-cover">Foto Siswa (Opsional)</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input"
                  name="gambar_cover" id="gambar-cover" lang="id" 
                  @change="updateFoto" form="form-siswa">
                  <label class="custom-file-label" for="gambar-cover">
                    {{ photoLabel }}
                  </label>
                  <has-error :form="form" field="photo"></has-error>
                </div>
              </div>

                <div class="row justify-content-between my-2">
                  <div class="col-sm-6 col-md-4 col-lg-3 order-sm-2">
                    <button type="submit" class="btn btn-block btn-success">
                      <span>Tambahkan</span>
                    </button>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 my-1 my-sm-0">
                    <router-link :to="{ name:'siswa' }" 
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
              <h3 class="card-title mb-0">Foto Siswa</h3>
            </div>
            <div class="card-body">
              <img
              class="img-fluid img-thumbnail my-center-img" 
              :src="form.foto? form.foto : './svg/user.svg'" 
              alt="foto-siswa" height="250" width="250" 
              style="objectFit:cover;borderRadius:50%;transition:all 1s">
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
            photoLabel: 'Pilih Foto',
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

        
    },
    mounted() {
      this.$Progress.finish();
    }
};

</script>
