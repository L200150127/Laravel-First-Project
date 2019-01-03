<style>
.widget-user-header {
  background-position: center center;
  background-size: cover;
}
</style>

<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card card-primary card-outline" style="height: 460px;">
          <div class="card-body box-profile">
            <div class="text-center">
              <img
              class="profile-user-img img-fluid img-circle" 
              :src="form.photo? form.photo : './svg/user.svg'" 
              :alt="'foto ' + form.name" 
              :height="form.bio? 100 : 250" 
              :width="form.bio? 100 : 250" 
              :style="{objectFit: 'cover', width: form.bio? '100px' : '250px', height:form.bio? '100px' : '250px', borderRadius: '50%', transition: 'all 1s'}">
            </div>
            <hr>
            <h3 class="profile-username text-center">
              {{ form.name | capitalize }}
            </h3>
            <p class="text-muted text-center">
              {{ form.email | capitalize(true) }}
            </p>
            <div v-if="form.bio">
              <hr>
              <b>Bio</b>
              <hr>{{ form.bio }}
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <div class="col-md-8">
        <div class="card" style="height: 460px">
          <!-- .card-header -->
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link active show" href="#profil" 
                data-toggle="tab">Profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" 
                href="#ganti-password" data-toggle="tab">
                Ganti Password</a>
              </li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active show" id="profil">
                <!-- Form Profil -->
                <form @submit.prevent="updateProfil()" 
                @keydown="form.onKeydown($event)" 
                enctype="multipart/form-data">
                  <div class="form-group">
                    <input v-model="form.name" type="text" name="name" id="name" 
                    class="form-control" placeholder="Username" required
                    :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-group">
                    <input v-model="form.email" type="email" name="email" 
                    id="email" :class="{ 'is-invalid': form.errors.has('email') }"
                    class="form-control" placeholder="Alamat Email" required>
                    <has-error :form="form" field="email"></has-error>
                  </div>
                  <div class="form-group">
                    <textarea v-model="form.bio" name="bio" id="bio" 
                    class="form-control" placeholder="Bio Singkat (Opsional)"
                    :class="{ 'is-invalid': form.errors.has('bio') }"
                    ></textarea>
                    <has-error :form="form" field="bio"></has-error>
                  </div>
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
                  <div class="form-group">
                    <input v-model="form.password" type="password" name="password" 
                    class="form-control" placeholder="Password" id="password"
                    :class="{ 'is-invalid': form.errors.has('password') }" 
                    required> 
                    <has-error :form="form" field="password"></has-error>
                  </div>
                  <button type="button" class="btn btn-danger" 
                  @click="resetForm">Batal</button>
                  <button type="submit" class="btn btn-success">
                  Simpan Perubahan</button>
                  
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="ganti-password">
                <!-- Form Profil -->
                <form @submit.prevent="updateProfil()" 
                @keydown="form.onKeydown($event)">
                  <div class="form-group">
                    <input v-model="form.password" type="password" 
                    name="password" class="form-control" 
                    placeholder="Masukan Password Sekarang" id="password"
                    :class="{ 'is-invalid': form.errors.has('password') }" required> 
                    <has-error :form="form" field="password"></has-error>
                  </div>
                  <hr>
                  <div class="form-group">
                    <input v-model="form.password_baru" type="password" 
                    name="password" class="form-control" 
                    placeholder="Masukan Password Baru" id="password-baru"
                    :class="{ 'is-invalid': form.errors.has('password_baru') }"
                    required> 
                    <has-error :form="form" field="password_baru"></has-error>
                  </div>
                  <div class="form-group">
                    <input v-model="form.password_baru_confirmation" 
                    type="password" name="password_baru_confirmation" 
                    id="password-baru-confirm" class="form-control" 
                    placeholder="Ulangi Password Baru"
                    :class="{ 'is-invalid': form.errors.has('password_baru') }"
                    required>
                    <has-error :form="form" field="password_baru_confirmation"></has-error>
                  </div>
                  <button type="reset" class="btn btn-danger">
                    Batal
                  </button>
                  <button type="submit" class="btn btn-success">
                    Simpan Perubahan
                  </button>
                </form>
              </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</template>



<script>
export default {
    data() {
        return {
            form: new Form({
                id      : '',
                name    : '',
                email   : '',
                password: '',
                password_baru: '',
                bio     : '',
                photo   : ''
            }),
            formLama: new Form({
                name : '',
                email: '',
                bio  : '',
                photo: ''
            }),
            photoLabel: 'Pilih Foto (Opsional)'
        }
    },
    methods: {
        resetForm(){
            this.form.name  = this.formLama.name;
            this.form.email = this.formLama.email;
            this.form.bio   = this.formLama.bio;
            this.form.photo = this.formLama.photo;
            this.photoLabel = this.form.photo;
        },
        updateProfil() {
            this.$Progress.start();
            // Submit form melualu POST request
            this.form.patch('api/profil')
                    .then(({ data }) => {
                        this.$emit('afterUpdate');
                        this.photoLabel = data.photo;
                        toast({
                          type: 'success',
                          title: 'Data Profil  berhasil diupdate'
                        });
                        this.$Progress.finish();
                    })
                    .catch((error) => {
                        this.$Progress.fail();
                        toast({
                          type: 'error',
                          title: 'Data Profil gagal diupdate'
                        });
                        console.log(error);
                    });
        },
        updateFoto(e) {
            let file        = e.target.files[0];
            this.photoLabel = file.name;
            let reader      = new FileReader();

            if (file['size'] < 2111775) {
                reader.onloadend = (file) => {
                  // console.log('RESULT', reader.result)
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
        loadData() {
            this.$Progress.start();
            axios.get('api/profil')
                .then(({ data }) => {
                    this.form.fill(data);
                    this.formLama.fill(data);
                    this.photoLabel = data.photo;
                    this.$Progress.finish();
                })
                .catch((error) => {
                    this.$Progress.fail();
                    console.log(error);
                });
        },
    },
    created() {
        this.loadData();
        this.$on('afterUpdate', () => this.loadData());
    }
}
</script>