<template>
  <div class="container">
    <div class="row mt-2 justify-content-center d-flex" v-if="$gate.isAdmin()">
      <div class="col-lg-8">

        <!-- Card Kalender Sekolah -->
        <div class="card border border-primary">

          <div class="card-header bg-primary">
            <h3 class="card-title m-0 p-2">Kalender Sekolah</h3>

            <!-- Tombol tambah agenda -->
            <div class="card-tools">
              <button class="btn btn-success" @click="tambahDataModal"> 
                <i class="far fa-calendar-plus"></i> 
                <span class="text-responsive">Tambah Agenda</span>
              </button>
            </div>
          </div>

          <div class="card-body">
            <full-calendar :events="agenda" 
            :config="config" :editable="false" :selectable="false"/>
          </div>

          <div class="card-footer">
          </div><!-- /.card-footer -->

        </div><!-- /Card Kalender Sekolah -->
      </div>

      <div class="col-lg-4">

        <!-- Card Daftar Agenda Sekolah -->
        <div class="card border border-primary">

          <div class="card-header bg-primary">
            <h3 class="card-title m-0 p-2">Daftar Agenda</h3>
          </div>

          <ul class="list-group list-group-flush">

            <li class="list-group-item" 
            v-for="(dt, index) in laravelData.data">
              <p>
                {{ dt.nama | capitalize }} -
                <small class="text-muted">{{ dt.jenis | capitalize }}</small>
              </p>

              <p>
                <small class="text-muted">
                  <strong>Deskripsi :</strong>
                  {{ dt.deskripsi | capitalize(true) }}<br>
                  <strong>Tanggal :</strong> 
                  <span v-if="dt.tgl_mulai == dt.tgl_selesai">
                    {{ dt.tgl_mulai | date_id_short }}
                  </span>
                  <span v-else>
                    {{ dt.tgl_mulai | date_id_short }} - 
                    {{ dt.tgl_selesai | date_id_short }}
                  </span>
                </small>
              </p>
              <div class="row justify-content-between">
                <div class="col-sm-6 col-md-4 col-lg-3">
                  <button type="button" title="Edit"
                  class="btn btn-link btn-block text-info"
                  @click="editDataModal(dt)">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                  <button type="button" title="Hapus"
                  class="btn btn-link btn-block text-danger"
                  @click="destroy(laravelData.links.self, dt.id, dt.nama)">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </div>
              </div>
            </li>

          </ul>

          <div class="card-footer">
            <pagination :data="laravelData" v-if="laravelData.data"
            @pagination-change-page="getResults" :show-disabled="true" 
            :limit="5">
              <span slot="prev-nav"><i class="fas fa-arrow-circle-left"></i></span>
              <span slot="next-nav"><i class="fas fa-arrow-circle-right"></i></span>
            </pagination>
          </div><!-- /.card-footer -->
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="crudModal" tabindex="-1" role="dialog" 
    aria-labelledby="TambahDataLabel" aria-hidden="true" 
    v-if="$gate.isAdmin()"> 
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border border-primary">
          <!-- Modal Header -->
          <div class="modal-header bg-primary">
            <h5 v-if="editMode" class="modal-title" id="TambahDataLabel">
              <span>Edit Agenda</span>
            </h5>
            <h5 v-else class="modal-title" id="TambahDataLabel">
              <span>Tambah Agenda</span>
            </h5>
            <button type="button" class="close text-light" 
            @click="closeModal('crudModal', 'zoomOut')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- Form -->
          <form @submit.prevent="performSubmit" 
          @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <!-- Input Nama Agenda -->
              <div class="form-group">
                <label for="id_guru">Nama</label>
                <input v-model.trim="form.nama" type="text" name="nama" 
                id="nama" placeholder="Nama Agenda"
                :class=
                "{'form-control': true, 'is-invalid': errors.has('nama')}"
                v-validate=
                "{ required: true, regex: /^[a-z\d\-\'\,\/\s]+$/i, max: 100 }"
                data-vv-as="Nama agenda">
                <!-- Feedback Error -->
                <div v-show="errors.has('nama')" class="invalid-feedback">
                  {{ errors.first('nama') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Nama -->

              <!-- Input Jenis -->
              <div class="form-group">
                <label for="jenis">Jenis</label>
                <select name="jenis" v-model="form.jenis" 
                id="jenis" :class="{'custom-select': true, 'is-invalid': errors.has('jenis')}" data-vv-as="Jenis agenda" 
                onfocus='this.size=5;' onblur='this.size=1;' 
                onchange='this.size=1;this.blur();' 
                v-validate="'required|alpha'">
                  <option value="" disabled>Pilih Jenis Agenda</option>
                  <option value="kegiatan">Kegiatan</option>
                  <option value="rapat">Rapat</option>
                  <option value="libur">Libur</option>
                  <option value="ujian">Ujian</option>
                </select>
                <!-- Feedback Error -->
                <div v-show="errors.has('jenis')" 
                class="invalid-feedback">
                  {{ errors.first('jenis') }}
                </div><!-- /Feedback Error -->
              </div><!-- /Input Jenis Agenda -->

              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea v-model.trim="form.deskripsi" name="deskripsi" 
                id="deskripsi" placeholder="Deskripsi Agenda"
                :class=
                "{'form-control': true, 'is-invalid': errors.has('deskripsi')}"
                v-validate=
                "{ required: true, regex: /^[a-z\d\-\'\,\.\:\/\s]+$/i, 
                max: 255 }"
                data-vv-as="Deskripsi agenda"></textarea>
                <!-- Feedback Error -->
                <div v-show="errors.has('deskripsi')" 
                class="invalid-feedback">
                  {{ errors.first('deskripsi') }}
                </div><!-- /Feedback Error -->
              </div>

              <div class="form-group">
                <label for="warna">Warna</label>
                <input type="color" id="warna" v-model="form.warna"
                placeholder="Warna Penanda Agenda" name="warna"
                :class=
                "{'form-control': true, 'is-invalid': errors.has('warna')}"
                v-validate=
                "{ regex: /^#(?:[0-9a-fA-F]{6}){1,2}$/i }"
                data-vv-as="Warna penanda agenda">
                <!-- Feedback Error -->
                <div v-show="errors.has('warna')" 
                class="invalid-feedback">
                  {{ errors.first('warna') }}
                </div><!-- /Feedback Error -->
              </div>

              <!-- Input Tanggal Mulai dan Tanggal Selesai -->
              <div class="form-group">
                <div class="form-row">
                  <div class="col">
                    <label for="tgl-mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tgl-mulai"
                    name="tgl_mulai" data-vv-as="Tanggal mulai"
                    :class="{'is-invalid': errors.has('tgl_mulai')}" 
                    v-validate="'required|date_format:YYYY-MM-DD'" 
                    v-model="form.tgl_mulai" ref="afterTarget">
                    <!-- Feedback Error -->
                    <div v-show="errors.has('tgl_mulai')" 
                    class="invalid-feedback">
                      {{ errors.first('tgl_mulai') }}
                    </div><!-- /Feedback Error -->
                  </div>
                  <div class="col">
                    <label for="tgl-selesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tgl-selesai"
                    name="tgl_selesai" data-vv-as="Tanggal selesai"
                    :class="{'is-invalid': errors.has('tgl_selesai')}" 
                    v-validate="'required|date_format:YYYY-MM-DD'" 
                    v-model="form.tgl_selesai">
                    <!-- Feedback Error -->
                    <div v-show="errors.has('tgl_selesai')" 
                    class="invalid-feedback">
                      {{ errors.first('tgl_selesai') }}
                    </div><!-- /Feedback Error -->
                  </div>
                </div>
              </div>

              <hr>

              <!-- Tombol Aksi -->
              <div class="row justify-content-between">
                <div class="col-sm-5">
                  <button type="button" class="btn btn-block btn-danger" 
                  @click="closeModal('crudModal', 'zoomOut')">Batal</button>
                </div>
                <div class="col-sm-5 mt-1 mt-sm-0">
                  <button v-if="editMode" type="submit" 
                  class="btn btn-success btn-block" :disabled="errors.any()">
                    Simpan Perubahan
                  </button>
                  <button v-else type="submit" 
                  class="btn btn-success btn-block" :disabled="errors.any()">
                    Tambahkan
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <not-found v-else></not-found>
  </div>
</template>

<script>
// Impor Vue-FullCalendar
import { FullCalendar } from 'vue-full-calendar';
import 'fullcalendar/dist/locale/id';
import "fullcalendar/dist/fullcalendar.min.css";
// Impor Moment.JS
import moment from 'moment';
// Import Mixins
import crudMixins from '../../mixins/crudMixins';
import modalMixins from '../../mixins/modalMixins';

export default {
    components: {
        FullCalendar,
    },
    data() {
        return {
            editMode:true,
            laravelData: {},
            form       : new Form({
                id         : '',
                nama       : '',
                jenis      : '',
                deskripsi  : '',
                warna      : '#ef7800',
                tgl_mulai  : '',
                tgl_selesai: '',
            }),
            agenda: [],
            config: {
                locale: 'id',
                defaultView: 'month',
                themeSystem: 'bootstrap4',
                height: 540,
                weekNumbers: true,
                weekNumbersWithinDays: true,
                eventRender: function(eventObj, $el) {
                    $el.popover({
                        title: eventObj.title,
                        content: eventObj.description,
                        trigger: 'hover',
                        placement: 'top',
                        container: 'body'
                    });
                },
            },
        }
    },
    methods: {
        tambahDataModal() {
            this.editMode = false;
            this.clearForm();
            this.openModal('crudModal', 'zoomIn');
        },
        editDataModal(dataSingle) {
            this.editMode = true;
            this.clearForm();
            this.form.fill(dataSingle);
            this.openModal('crudModal', 'zoomIn');
        },
        clearForm() {
            this.form.reset();
            this.$validator.reset();
        },
        getResults(page = 1) {
            if (page == this.laravelData.meta.current_page) {
                return;
            }
            this.$Progress.start();
            let halaman = '?page=' + page;
            axios.get(this.laravelData.meta.path + halaman)
                .then( response => {
                    this.laravelData = response.data;
                    this.$Progress.finish();
                });
        },
        performSubmit() {
            if (this.editMode) {
                return this.update(this.laravelData.links.self);
            } else {
                return this.create(this.laravelData.links.self);
            }
        },
        read(urlApi) {
            let apiPreffix = 'api/';
            return axios.get(apiPreffix + urlApi);
        },
        startConcurent() {
            this.$Progress.start();
            axios.all([
                this.read('agenda'),
                this.read('semua-agenda'),
                ])
                .then(axios.spread((agenda, allAgenda) => {
                    this.laravelData = agenda.data;
                    this.agenda = allAgenda.data;
                    this.agenda = this.agenda.data.map(function(e) {
                        return {
                            'id' : e.id,
                            'title': e.nama,
                            'start': e.tgl_mulai,
                            'end': moment(new Date(e.tgl_selesai))
                            .add(1, 'days'),
                            'color': e.warna,
                            'description': e.deskripsi,
                            'allDay' : true,
                        };
                    });
                    this.$Progress.finish();
                }))
                .catch( err => {
                    this.$Progress.fail();
                    console.log(err);
                });
        },
    },
    mixins: [ crudMixins, modalMixins ]
    ,
    created() {
        this.startConcurent();
        this.$on('afterCrud', () => {
            this.startConcurent();
        });
    }
};
</script>

