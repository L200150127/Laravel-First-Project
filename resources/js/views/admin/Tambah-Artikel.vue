<template>
  <div class="container">
    <div class="row mt-2 justify-content-center">
        <div class="col-md-8 order-md-1 order-2">

          <!-- Card Container Formulir tambah artikel -->
          <div class="card border border-primary">

            <div class="card-header bg-primary">
              <h3 class="card-title mb-0">Buat Artikel</h3>
            </div><!-- /.card-header -->

            <div class="card-body">
              <!-- Form -->
              <form @submit.prevent="performSubmit" id="form-artikel">

                <!-- Input Judul Artikel -->
                <div class="form-group">
                  <label for="judul">Judul Artikel</label>
                  <input v-model.trim="form.judul" type="text" name="judul" 
                  id="judul" placeholder="Masukan Judul Artikel"
                  :class="{'form-control': true, 'is-invalid': errors.has('judul')}" v-validate=
                  "{ required: true, regex: /^[a-z\d\-\'\,\.\:\/\s]+$/i, 
                  max: 255 }">
                  <!-- Feedback Error -->
                  <div v-show="errors.has('judul')" class="invalid-feedback">
                    {{ errors.first('judul') }}
                  </div><!-- /Feedback Error -->
                </div>

                <!-- Input file Foto -->
                <div class="form-group">
                  <label for="gambar_cover">Sampul Artikel (Opsional)</label>
                  <div class="custom-file">
                    <input type="file" name="gambar_cover" id="gambar_cover" lang="id" :class="{'custom-file-input': true, 'is-invalid': errors.has('gambar_cover')}" v-validate=
                    "{ image: true, size: 4096 }"
                    @change="updateFile" data-vv-as="Sampul Artikel">
                    <label class="custom-file-label" for="gambar_cover">
                      {{ fileLabel }}
                    </label>
                    <!-- Feedback Error -->
                    <div v-show="errors.has('gambar_cover')" 
                    class="invalid-feedback">
                      {{ errors.first('gambar_cover') }}
                    </div><!-- /Feedback Error -->
                  </div>
                </div><!-- /Input file Foto -->
                
                <!-- Input Isi artikel -->
                <!-- Input Isi artikel -->
                <div class="form-group">
                  <label for="isi">Isi Artikel</label>
                  <vue-editor v-model="form.isi" name="isi" 
                  data-vv-as="Isi Artikel" placeholder="Masukan Isi Artikel" v-validate="'required'">
                  </vue-editor>
                </div>

                <div class="row justify-content-between my-2">
                  <div class="col-sm-6 col-md-4 col-lg-3 order-sm-2">
                    <button type="submit" class="btn btn-block btn-success"
                    :disabled="errors.any()">
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
              <h3 class="card-title mb-0">Gambar Sampul</h3>
            </div>
            <div class="card-body">
              <img v-if="fotoPreview"
              class="img-fluid img-thumbnail" 
              :src="fotoPreview" 
              alt="foto-artikel" width="300" 
              style="object-fit:cover;transition:all 1s">
              <img v-else
              class="img-fluid img-thumbnail" 
              src="/storage/default/images/cover_default.png" 
              alt="foto-artikel" width="300" 
              style="object-fit:cover;transition:all 1s">
            </div>
          </div>
        </div>

    </div>
  </div>
</template>

<script>
import { VueEditor } from 'vue2-editor';

export default {
    components: {
        VueEditor
    },
    data() {
        return {
            laravelData: {},
            form       : {},
            fotoPreview: '',
            fileLabel  : 'Pilih File',
        }
    },
    methods: {
        clearForm() {
            this.form = {
                id          : '',
                judul       : '',
                isi         : '',
                gambar_cover: '',
            };
            this.fotoPreview = '';
            this.fileLabel   ='Pilih File';
            this.$validator.reset();
        },
        performSubmit() {
            if (typeof this.form.gambar_cover != 'object' || this.form.gambar_cover == null) {
                delete this.form.gambar_cover;
            }
            Object.keys(this.form).forEach( key => {
                if (this.form[key] == null) {
                    this.form[key] = '';
                }
            });
            return this.create('api/artikel');
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
                this.form.gambar_cover = file;
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
        create(urlApi) {
            let apiSuffix = urlApi.split('/').last();
            this.$validator.validateAll()
                .then(() => {
                    if (!this.errors.any()) {
                        let formData = this.getFormData(this.form);
                        const config = {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                        this.$Progress.start();
                        axios.post(urlApi, formData, config)
                            .then( response => {
                                this.$emit('afterCrud');
                                toast({
                                    type: 'success',
                                    title: `${ Vue.filter('capitalize')(apiSuffix) } baru berhasil ditambahkan`
                                });
                                this.$Progress.finish();
                                this.$nextTick(() => {
                                    this.clearForm();
                                });
                            })
                            .catch(err => {
                                this.$Progress.fail();
                                this.$setErrorsFromResponse(err.response.data);
                                toast({
                                    type: 'error',
                                    title: `
                                    Gagal menambahkan 
                                    ${ Vue.filter('capitalize')(apiSuffix) }`
                                });
                            });
                    }
                });
        },
    },
    mounted() {
        this.$Progress.finish();
    }
};

</script>