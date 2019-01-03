<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="accordion border border-primary rounded" 
        id="menu-accordion-bantuan">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Bantuan Mengenai Item #1
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#menu-accordion-bantuan">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" 
                aria-expanded="false" aria-controls="collapseTwo">
                  Bantuan Mengenai Item #2
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#menu-accordion-bantuan">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Bantuan Mengenai Item #3
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#menu-accordion-bantuan">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-3">
      <div class="col-md-12">
        <div class="card border border-primary">
            <div class="card-header bg-primary">File Bantuan</div>
            <div class="card-body table-responsive p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama File</th>
                    <th scope="col" class="text-center"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(user, index) in users.data">
                    <td>{{ index + 1 }}</td>
                    <td>Petunjuk Penggunaan Website</td>
                    <td>
                      <!-- Tombol Pilihan -->
                      <div 
                      class="btn-group btn-group-sm d-flex ml-auto">
                        <a href="javascript:void(0)" class="btn btn-outline-primary flex-fill"
                        title="Edit" data-toggle="modal" data-target="#crudModal"
                        @click="editDataModal(user)">
                          <i class="fas fa-download"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
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

