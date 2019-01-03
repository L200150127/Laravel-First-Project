<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card border border-primary">
          <div class="card-header bg-primary">
            <h3 class="card-title">Foto Foto Sekolah</h3>

            <!-- Tombol tambah foto -->
            <div class="card-tools">
              <button class="btn btn-success" @click="tambahDataModal"> 
                <i class="fas fa-plus-circle"></i> 
                <span class="text-responsive">Tambah Foto</span>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6 col-md-4">
                <div class="card album-container mb-3">
                  <div style="overflow: hidden">
                    <a href="/img/park.jpg">
                      <img src="/img/park.jpg" alt="album_image" 
                      class="card-img-top rounded-top" width="250" height="200"
                      style="object-fit: cover;">
                    </a>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">
                      <a href="/img/park.jpg">
                        Nama Foto
                      </a>
                    </h5>
                    <p class="card-text">Deskripsi</p>
                    <p class="card-text">
                      <small class="text-muted">
                        Dibuat: 
                      </small>
                    </p>
                    <a href="#" class="float-right btn btn-link text-danger">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                    <a href="#" class="float-left btn btn-link text-info">
                      <i class="fas fa-edit"></i>
                    </a>      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal -->
    <div style="position:absolute">
      <div class="modal fade" id="crudModal" tabindex="-1" role="dialog" 
      aria-labelledby="TambahDataLabel" aria-hidden="true" 
      v-if="$gate.isAdmin()">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h5 v-if="editMode" class="modal-title" id="TambahDataLabel">
                Edit Foto</h5>
              <h5 v-else class="modal-title" id="TambahDataLabel">
                Tambah Foto</h5>
              <button type="button" class="close" data-dismiss="modal" 
              aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- Form -->
            <form @submit.prevent="editMode? updateUser():createUser()" 
            @keydown="form.onKeydown($event)" enctype="multipart/form-data">
              <div class="modal-body">

                <!-- Input Nama Foto-->
                <div class="form-group">
                  <input v-model.trim="form.nama" type="text" nama="nama" id="nama" 
                  class="form-control" placeholder="Nama Foto" required
                  :class="{ 'is-invalid': form.errors.has('nama') }">
                  <has-error :form="form" field="nama"></has-error>
                </div>

                <!-- Input Deskripsi Foto-->
                <div class="form-group">
                  <textarea v-model.trim="form.deskripsi" name="deskripsi" id="deskripsi" 
                  class="form-control" placeholder="Deskripsi Foto (Opsional)"
                  :class="{ 'is-invalid': form.errors.has('deskripsi') }"></textarea>
                  <has-error :form="form" field="deskripsi"></has-error>
                </div>

                <!-- Input File Foto Foto-->
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
              page: 'Manajemen Foto'
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
                      title: 'Foto baru berhasil ditambahkan'
                  });
                  this.$Progress.finish();
                  this.form.reset();
              }).catch((error) => {
                  this.$Progress.fail();
                  toast({
                      type: 'error',
                      title: 'Foto baru gagal ditambahkan'
                  });
                  console.log(error);
              });
          },
          loadFoto() {
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
          updateFoto(id) {
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
          deleteFoto(id, nama) {
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
                              'Foto berhasil dihapus.',
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
          this.loadFoto();
          this.$on('afterCrud', () => this.loadFoto());
      }
  };
</script>