<template>
  <div class="container">
    <div class="row mt-2 justify-content-center">
        <div class="col-md-5 order-md-1 order-2">
          <div class="card border border-primary">
            <div class="card-header bg-primary">
              <h3 class="card-title mb-0">Logo Website</h3>
            </div>
            <div class="card-body">
              <img
              class="img-fluid img-thumbnail my-center-img" 
              :src="form.foto? form.foto : './img/logopuc.png'" 
              alt="foto-guru" height="250" width="250" 
              style="objectFit:cover;borderRadius:50%;transition:all 1s">
            </div>
          </div>
          <div class="card border border-primary">
            <div class="card-header bg-primary">
              <h3 class="card-title mb-0">Informasi Website</h3>
            </div>
            <div class="card-body">
              <!-- Form -->
              <form @submit.prevent="editMode? updateUser():createUser()" 
              @keydown="form.onKeydown($event)" enctype="multipart/form-data" 
              id="form-guru">

                <!-- Input Nama -->
                <div class="form-group">
                  <label for="judul">Nama</label>
                  <input v-model.trim="form.nama" type="text" name="nip" 
                  id="nip" class="form-control"
                  placeholder="Nama Website"
                  :class="{ 'is-invalid': form.errors.has('name') }">
                  <has-error :form="form" field="nip"></has-error>
                </div>

                <!-- Input File Logo Sekolah -->
                <div class="form-group">
                  <label for="gambar-cover">Logo Website</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input"
                    name="gambar_cover" id="gambar-cover" lang="id" 
                    @change="updateFoto" form="form-guru">
                    <label class="custom-file-label" for="gambar-cover">
                      {{ photoLabel }}
                    </label>
                    <has-error :form="form" field="photo"></has-error>
                  </div>
                </div>

                <!-- Input Nama -->
                <div class="form-group">
                  <label for="email">Email</label>
                  <input v-model.trim="form.email" type="email" name="email" 
                  id="email" class="form-control" 
                  placeholder="Email Sekolah" required
                  :class="{ 'is-invalid': form.errors.has('email') }">
                  <has-error :form="form" field="email"></has-error>
                </div>

                <!-- Input Nama -->
                <div class="form-group">
                  <label for="email">Telepon</label>
                  <input v-model.trim="form.telepon" type="telepon" 
                  name="telepon" 
                  id="telepon" class="form-control" 
                  placeholder="Nomor Telepon Sekolah" required
                  :class="{ 'is-invalid': form.errors.has('telepon') }">
                  <has-error :form="form" field="telepon"></has-error>
                </div>

                <!-- Alamat-->
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea v-model.trim="form.bio" name="alamat" id="alamat" 
                  class="form-control" placeholder="Alamat Sekolah"
                  :class="{ 'is-invalid': form.errors.has('alamat') }">
                  </textarea>
                  <has-error :form="form" field="alamat"></has-error>
                </div>

                <!-- Input Tahun ajaran -->
                <div class="form-group">
                  <label for="tahun-ajaran">Tahun Ajaran</label>
                  <input v-model.trim="form.tahun_ajaran" type="text" 
                  name="tahun_ajaran" id="tahun-ajaran" class="form-control" 
                  placeholder="Tahun Ajaran Sekarang (YYYY)" required
                  :class="{ 'is-invalid': form.errors.has('tahun_ajaran') }">
                  <has-error :form="form" field="tahun_ajaran"></has-error>
                </div>

                <!-- Visi-->
                <div class="form-group">
                  <label for="visi">Visi</label>
                  <textarea v-model.trim="form.bio" name="visi" id="visi" 
                  class="form-control" placeholder="Visi Sekolah"
                  :class="{ 'is-invalid': form.errors.has('visi') }">
                  </textarea>
                  <has-error :form="form" field="visi"></has-error>
                </div>

                <!-- Misi-->
                <div class="form-group">
                  <label for="misi">Misi</label>
                  <textarea v-model.trim="form.bio" name="misi" id="misi" 
                  class="form-control" placeholder="Misi Sekolah"
                  :class="{ 'is-invalid': form.errors.has('misi') }">
                  </textarea>
                  <has-error :form="form" field="misi"></has-error>
                </div>

                <!-- Tujuan-->
                <div class="form-group">
                  <label for="tujuan">Tujuan</label>
                  <textarea v-model.trim="form.bio" name="tujuan" id="tujuan" 
                  class="form-control" placeholder="Tujuan Sekolah"
                  :class="{ 'is-invalid': form.errors.has('tujuan') }">
                  </textarea>
                  <has-error :form="form" field="tujuan"></has-error>
                </div>

                <div class="row my-2">
                  <div class="col-sm-6 col-md-4 col-lg-4 ml-auto">
                    <button type="submit" class="btn btn-block btn-success">
                      <span>Simpan</span>
                    </button>
                  </div>
                </div>
              </form>
                  
            </div>
          </div>
        </div>

        <div class="col-md-7 order-md-2 order-1">
          <div class="row">
            
            <div class="col-md-12">
              <div class="card border border-primary">
                <div class="card-header bg-primary">
                  <h3 class="card-title mb-0">Banner Website</h3>
                </div>
                <div class="card-body">
                  <div class="card galeri-dashboard">
                    <div style="overflow: hidden">
                      <a href="#">
                        <img src="/img/rails.jpg" alt="album_image" class="card-img rounded" height="200" style="object-fit: cover;">
                      </a>
                    </div>
                    <div class="card-img-overlay">
                        <span class="card-text text-white">
                        Nama Acara Atau Kegiatan Untuk Banner 1</span>
                        <a href="#" class="card-text float-right">
                          <i class="fas fa-edit text-white"></i>
                        </a>
                    </div>
                  </div>
                  <hr>
                  <div class="card galeri-dashboard">
                    <div style="overflow: hidden">
                      <a href="#">
                        <img src="/img/rails.jpg" alt="album_image" class="card-img rounded" height="200" style="object-fit: cover;">
                      </a>
                    </div>
                    <div class="card-img-overlay">
                        <span class="card-text text-white">
                        Nama Acara Atau Kegiatan Untuk Banner 2</span>
                        <a href="#" class="card-text float-right">
                          <i class="fas fa-edit text-white"></i>
                        </a>
                    </div>
                  </div>
                  <hr>
                  <div class="card galeri-dashboard">
                    <div style="overflow: hidden">
                      <a href="#">
                        <img src="/img/rails.jpg" alt="album_image" class="card-img rounded" height="200" style="object-fit: cover;">
                      </a>
                    </div>
                    <div class="card-img-overlay">
                        <span class="card-text text-white">
                        Nama Acara Atau Kegiatan Untuk Banner 3</span>
                        <a href="#" class="card-text float-right">
                          <i class="fas fa-edit text-white"></i>
                        </a>
                    </div>
                  </div>
                  <hr>
                  <div class="card galeri-dashboard">
                    <div style="overflow: hidden">
                      <a href="#">
                        <img src="/img/rails.jpg" alt="album_image" class="card-img rounded" height="200" style="object-fit: cover;">
                      </a>
                    </div>
                    <div class="card-img-overlay">
                        <span class="card-text text-white">
                        Nama Acara Atau Kegiatan Untuk Banner 4</span>
                        <a href="#" class="card-text float-right">
                          <i class="fas fa-edit text-white"></i>
                        </a>
                    </div>
                  </div>
                </div>                  
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
    }
};

</script>
