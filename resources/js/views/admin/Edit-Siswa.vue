<template>
  <div class="container">
    <div class="row mt-2 justify-content-center">
        <div class="col-md-8 order-md-1 order-2">

          <!-- Card Container Formulir edit siswa -->
          <div class="card border border-primary">

            <div class="card-header bg-primary">
              <h3 class="card-title mb-0">Edit Siswa</h3>
            </div><!-- /.card-header -->

            <div class="card-body">
              <!-- Form -->
              <form @submit.prevent="performSubmit">

                <!-- Input NIS -->
                <div class="form-group">
                  <label for="nis">NIS</label>
                  <input v-model.trim="form.nis" type="text" name="nis" 
                  id="nis" class="form-control" placeholder="Masukan NIS Siswa"
                  data-vv-as="NIS siswa" :class="{'form-control': true, 'is-invalid': errors.has('nis')}"
                  v-validate="'required|numeric|digits:18'">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('nis')" class="invalid-feedback">
                    {{ errors.first('nis') }}
                  </div><!-- /Feedback Error -->
                </div><!-- /Input NIS -->

                <!-- Input NISN -->
                <div class="form-group">
                  <label for="nisn">NISN</label>
                  <input v-model.trim="form.nisn" type="text" name="nisn" 
                  id="nisn" class="form-control" data-vv-as="NIS siswa"
                  placeholder="Masukan NISN Siswa" :class="{'form-control': true, 'is-invalid': errors.has('nisn')}"
                  v-validate="'numeric|digits:10'">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('nisn')" class="invalid-feedback">
                    {{ errors.first('nisn') }}
                  </div><!-- /Feedback Error -->
                </div><!-- /Input NIS -->

                <!-- Input Nama -->
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input v-model.trim="form.nama" type="text" name="nama" 
                  id="nama" class="form-control" data-vv-as="Nama siswa"
                  placeholder="Masukan Nama Siswa" :class="{'form-control': true, 'is-invalid': errors.has('nama')}"
                  v-validate="{ required: true, regex: /^[a-z\d\-\'\,\/\.\s]+$/i, max: 50 }">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('nama')" class="invalid-feedback">
                    {{ errors.first('nama') }}
                  </div><!-- /Feedback Error -->
                </div><!-- /Input Nama -->

                <!-- Radio jenis kelamin -->
                <label for="jkl">Jenis Kelamin</label>
                <div class="form-group">
                  <div class="custom-control custom-radio 
                  custom-control-inline">
                    <input type="radio" id="jkl" name="jenis_kelamin" 
                    class="custom-control-input" v-model="form.jenis_kelamin"
                    value="L" v-validate="'required|included:L,P'">
                    <label class="custom-control-label" for="jkl">
                    Laki-laki</label>
                  </div>
                  <div class="custom-control custom-radio 
                  custom-control-inline">
                    <input type="radio" id="jkp" name="jenis_kelamin" 
                    class="custom-control-input" v-model="form.jenis_kelamin"
                    value="P">
                    <label class="custom-control-label" for="jkp">
                    Perempuan</label>
                  </div>
                  <!-- Feedback Error -->
                  <div v-show="errors.has('jenis_kelamin')" 
                  class="invalid-feedback">
                    {{ errors.first('jenis_kelamin') }}
                  </div><!-- /Feedback Error -->
                </div><!-- /Radio jenis kelamin -->
                
                <!-- Textarea Alamat -->
                <div class="form-group">
                  <label for="deskripsi">Alamat</label>
                  <textarea v-model.trim="form.alamat" name="alamat" 
                  id="alamat" placeholder="Masukan Alamat"
                  :class=
                  "{'form-control': true, 'is-invalid': errors.has('alamat')}"
                  v-validate=
                  "{ regex: /^[a-z\d\-\'\,\.\:\/\s]+$/i, 
                  max: 255 }"
                  data-vv-as="Alamat"></textarea>
                  <!-- Feedback Error -->
                  <div v-show="errors.has('alamat')" 
                  class="invalid-feedback">
                    {{ errors.first('alamat') }}
                  </div><!-- /Feedback Error -->
                </div><!-- /textarea alamat -->

                <!-- Input Tanggal Lahir -->
                <div class="form-group">
                  <label for="tgl-lahir">Tanggal Lahir</label>
                  <input type="date" class="form-control" id="tgl-lahir"
                  name="tgl_lahir" data-vv-as="Tanggal lahir"
                  :class="{'is-invalid': errors.has('tgl_lahir')}" 
                  v-validate=
                  "'date_format:YYYY-MM-DD'" 
                  v-model="form.tgl_lahir" ref="afterTarget">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('tgl_lahir')" 
                  class="invalid-feedback">
                    {{ errors.first('tgl_lahir') }}
                  </div><!-- /Feedback Error -->
                </div>

                <!-- Radio status siswa -->
                <label for="siswa-aktif">Status Siswa</label>
                <div class="form-group">
                  <div class="custom-control custom-radio 
                  custom-control-inline">
                    <input type="radio" id="siswa-aktif" name="status" 
                    class="custom-control-input" v-model="form.status"
                    value="0" v-validate="'required|included:0,1'">
                    <label class="custom-control-label" for="siswa-aktif">
                    Siswa Aktif</label>
                  </div>
                  <div class="custom-control custom-radio 
                  custom-control-inline">
                    <input type="radio" id="alumni" name="status" 
                    class="custom-control-input" v-model="form.status"
                    value="1">
                    <label class="custom-control-label" for="alumni">
                    Alumni</label>
                  </div>
                  <!-- Feedback Error -->
                  <div v-show="errors.has('status')" 
                  class="invalid-feedback">
                    {{ errors.first('status') }}
                  </div><!-- /Feedback Error -->
                </div><!-- /Radio status siswa -->

                <!-- Input Tahun Masuk dan Tahun Lulus -->
                <div class="form-group">
                  <div class="form-row">
                    <div class="col">
                      <label for="tahun-masuk">Tahun Masuk</label>
                      <input v-model.trim="form.tahun_masuk" type="text" name="tahun_masuk" 
                      id="tahun-masuk" placeholder="Tahun Masuk (YYYY)"
                      :class="{'form-control': true, 'is-invalid': errors.has('tahun_masuk')}" data-vv-as="Tahun masuk"
                      v-validate="'date_format:YYYY'"
                      data-vv-delay="650" ref="tahunMasuk">
                      <!-- Feedback Error -->
                      <div v-show="errors.has('tahun_masuk')" class="invalid-feedback">
                        {{ errors.first('tahun_masuk') }}
                      </div><!-- /Feedback Error -->
                    </div>
                    <div class="col">
                      <label for="tahun-lulus">Tahun Lulus</label>
                      <input v-model.trim="form.tahun_lulus" type="text" 
                      name="tahun_lulus" id="tahun-lulus" 
                      placeholder="Tahun Lulus (YYYY)" :class="{'form-control': true, 'is-invalid': errors.has('tahun_lulus')}" data-vv-as="Tahun lulus"
                      v-validate=
                      "'date_format:YYYY|after:tahunMasuk'"
                      data-vv-delay="650">
                      <!-- Feedback Error -->
                      <div v-show="errors.has('tahun_lulus')" class="invalid-feedback">
                        {{ errors.first('tahun_lulus') }}
                      </div><!-- /Feedback Error -->
                    </div>
                  </div>
                </div>

                <!-- Input file Foto -->
                <div class="form-group">
                  <label for="foto">Foto Siswa (Opsional)</label>
                  <div class="custom-file">
                    <input type="file" name="foto" id="foto" lang="id"
                    :class="{'custom-file-input': true, 'is-invalid': errors.has('foto')}" v-validate=
                    "{ image: true, size: 4096 }"
                    @change="updateFile" data-vv-as="File foto">
                    <label class="custom-file-label" for="foto">
                      {{ fileLabel }}
                    </label>
                    <!-- Feedback Error -->
                    <div v-show="errors.has('foto')" 
                    class="invalid-feedback">
                      {{ errors.first('foto') }}
                    </div><!-- /Feedback Error -->
                  </div>
                </div><!-- /Input file Foto -->

                <div class="row justify-content-between my-2">
                  <div class="col-sm-6 col-md-4 col-lg-3 order-sm-2">
                    <button type="submit" class="btn btn-block btn-success"
                    :disabled="errors.any()">
                      <span>Simpan Perubahan</span>
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
            </div><!-- /.card-body -->
          </div>
        </div>

        <div class="col-md-4 order-md-2 order-1">
          <div class="card border border-primary">
            <div class="card-header bg-primary">
              <h3 class="card-title mb-0">Foto Siswa</h3>
            </div>
            <div class="card-body">
              <img v-if="fotoPreview"
              class="img-fluid img-thumbnail my-center-img" 
              :src="fotoPreview" 
              alt="foto-siswa" height="250" width="250" 
              style="objectFit:cover;borderRadius:50%;transition:all 1s">
              <img v-else
              class="img-fluid img-thumbnail my-center-img" 
              src="/storage/default/svg/user.svg" 
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
            laravelData   : {},
            form          : {},
            fotoPreview     : '',
            fileLabel     : 'Pilih File',
        }
    },
    watch: {
        // call again the method if the route changes
        '$route': 'fetchData'
    },
    methods: {
        fetchData() {
            if (this.$route.params.id) {
                this.read('/api/siswa/' + this.$route.params.id);
            } else {
                this.read('/api/siswa');
            }
        },
        read(urlApi) {
            this.$Progress.start();
            axios.get(urlApi)
                .then(response => {
                    this.laravelData = response.data;
                    this.form = this.laravelData.data;
                    if (this.form.foto) {
                        this.fotoPreview = `/storage/foto/siswa/${this.form.foto}`;
                        this.fileLabel   = this.form.foto;
                    }
                    this.$Progress.finish();
                })
                .catch(err => {
                    this.$Progress.fail();
                    console.log(err);
                });
        },
        clearForm() {
            this.form = {
                id           : '',
                nis          : '',
                nisn         : '',
                nama         : '',
                alamat       : '',
                jenis_kelamin: '',
                tgl_lahir    : '',
                foto         : '',
                status       : '',
                tahun_masuk  : '',
                tahun_lulus  : '',
            };
            this.fotoPreview = '';
            this.fileLabel   ='Pilih File';
            this.$validator.reset();
        },
        performSubmit() {
            if (typeof this.form.foto != 'object' || this.form.foto == null) {
                delete this.form.foto;
            }
            Object.keys(this.form).forEach( key => {
                if (this.form[key] == null) {
                    this.form[key] = '';
                }
            });
            return this.update(this.laravelData.links.self);
        },
        updateFile(e) {
            let file = e.target.files[0];
            this.fileLabel = _.truncate( file.name, {
                'length': 50,
            });
            let reader = new FileReader();
            if (file['size'] < 4096000) {
                reader.onloadend = (file) => {
                  this.fotoPreview = reader.result;
                }
                this.form.foto = file;
                reader.readAsDataURL(file);
            } else {
                swal({
                    type: 'error',
                    title: 'Ups...',
                    text: 'Ukuran file harus dibawah 4MB',
                });
            }
        },
        getFormData(object, update=false) {
            const formData = new FormData();
            Object.keys(object).forEach( key => formData.append(key, object[key]));
            if (update) {
                formData.append('_method', 'PATCH');
            }
            return formData;
        },
        update(urlApi) {
            let apiSuffix = urlApi.split('/').last();
            this.$validator.validateAll()
                .then(() => { 

                    if (!this.errors.any()) {
                        let formData = this.getFormData(this.form, true);
                        const config = {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            },
                        }
                        this.$Progress.start();
                        axios.post(`${urlApi}/${this.form.id}`, formData, config)
                            .then( response => {
                                this.$emit('afterCrud');
                                toast({
                                    type: 'success',
                                    title: `Data ${ apiSuffix } berhasil diupdate`
                                });
                                $('#crudModal').modal('hide');
                                this.$Progress.finish();
                                this.$nextTick(() => {
                                    this.clearForm();
                                })
                                this.fileLabel = 'Pilih File';
                            })
                            .catch(err => {
                                this.$Progress.fail();
                                toast({
                                    type: 'error',
                                    title: `Data ${ apiSuffix } gagal diupdate`
                                });
                                console.log(err);
                            });
                    }
                })
                .catch( err => {
                    console.log(err);
                });
        },
    },
    created() {
        this.fetchData();
        this.$on('afterCrud', () => this.$router.push({ name: 'siswa' }));
    },
    mounted() {
      this.$Progress.finish();
    }
};

</script>
