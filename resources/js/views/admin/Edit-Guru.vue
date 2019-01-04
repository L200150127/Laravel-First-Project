<template>
  <div class="container">
    <div class="row mt-2 justify-content-center">
        <div class="col-md-8 order-md-1 order-2">

          <!-- Card Container Formulir edit guru -->
          <div class="card border border-primary">

            <div class="card-header bg-primary">
              <h3 class="card-title mb-0">Edit Guru</h3>
            </div><!-- /.card-header -->

            <div class="card-body">
              <!-- Form -->
              <form @submit.prevent="performSubmit">

                <!-- Input NIS -->
                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input v-model.trim="form.nip" type="text" name="nip" 
                  id="nip" class="form-control" placeholder="Masukan NIP Guru"
                  data-vv-as="NIS guru" :class="{'form-control': true, 'is-invalid': errors.has('nip')}"
                  v-validate="'numeric'">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('nip')" class="invalid-feedback">
                    {{ errors.first('nip') }}
                  </div><!-- /Feedback Error -->
                </div><!-- /Input NIS -->

                <!-- Input Nama -->
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input v-model.trim="form.nama" type="text" name="nama" 
                  id="nama" class="form-control" data-vv-as="Nama guru"
                  placeholder="Masukan Nama Guru" :class="{'form-control': true, 'is-invalid': errors.has('nama')}"
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
                </div><!-- /Input Tanggal Lahir -->

                <!-- Input Jabatan -->
                <div class="form-group">
                  <label for="jabatan">Jabatan</label>
                  <input v-model.trim="form.jabatan" type="text" name="jabatan" 
                  id="jabatan" class="form-control" data-vv-as="Jabatan guru"
                  placeholder="Masukan Jabatan Guru" :class="{'form-control': true, 'is-invalid': errors.has('jabatan')}"
                  v-validate="{ required: true, regex: /^[a-z\d\-\'\,\/\.\s]+$/i, max: 50 }">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('jabatan')" class="invalid-feedback">
                    {{ errors.first('jabatan') }}
                  </div><!-- /Feedback Error -->
                </div><!-- /Input Jabatan -->

                <!-- Input file Foto -->
                <div class="form-group">
                  <label for="foto">Foto Guru (Opsional)</label>
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
                    <router-link :to="{ name:'guru' }" 
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
              <h3 class="card-title mb-0">Foto Guru</h3>
            </div>
            <div class="card-body">
              <img v-if="fotoPreview"
              class="img-fluid img-thumbnail my-center-img" 
              :src="fotoPreview" 
              alt="foto-guru" height="250" width="250" 
              style="objectFit:cover;borderRadius:50%;transition:all 1s">
              <img v-else
              class="img-fluid img-thumbnail my-center-img" 
              src="/storage/default/svg/user.svg" 
              alt="foto-guru" height="250" width="250" 
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
            laravelData: {},
            form       : {},
            fotoPreview: '',
            fileLabel  : 'Pilih File',
        }
    },
    watch: {
        // call again the method if the route changes
        '$route': 'fetchData'
    },
    methods: {
        fetchData() {
            if (this.$route.params.id) {
                this.read('/api/guru/' + this.$route.params.id);
            } else {
                this.read('/api/guru');
            }
        },
        read(urlApi) {
            this.$Progress.start();
            axios.get(urlApi)
                .then( response => {
                    this.laravelData = response.data;
                    this.form = this.laravelData.data;
                    if (this.form.foto) {
                        this.fotoPreview = `/storage/foto/guru/${this.form.foto}`;
                        this.fileLabel   = this.form.foto;
                    }
                    this.$Progress.finish();
                })
                .catch( err => {
                    this.$Progress.fail();
                    console.log(err);
                });
        },
        clearForm() {
            this.form = {
                id           : '',
                nip          : '',
                nama         : '',
                jenis_kelamin: '',
                alamat       : '',
                jabatan      : '',
                tgl_lahir    : '',
                foto         : '',
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
        this.$on('afterCrud', () => this.$router.push({ name: 'guru' }));
    },
    mounted() {
      this.$Progress.finish();
    }
};

</script>
