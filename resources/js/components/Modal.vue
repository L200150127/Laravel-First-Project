<template>
    <!-- Modal -->
    <div class="modal fade" :id="modal.id" tabindex="-1" role="dialog" 
    :aria-labelledby="modal.label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered animated" role="document">
        <div class="modal-content border border-primary">
          <!-- Modal Header -->
          <div class="modal-header bg-primary">
            <h5 v-if="modal.editMode" class="modal-title" :id="modal.label">
              {{ modal.createlabel }}</h5>
            <h5 v-else class="modal-title" :id="modal.label">
              {{ modal.updatelabel }}</h5>
            <button type="button" class="close text-light" 
            @click="closeModal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <form @submit.prevent="editMode? 
          update(modal.uriUpdate) : create(modal.uriCreate)" 
          @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <slot></slot>
              <div class="row justify-content-between">
                <div class="col-sm-5">
                  <button type="button" class="btn btn-block btn-danger" 
                  @click="closeModal">Batal</button>
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
</template>

<script>
    export default {
        props: ['modal'],
        methods: {
          animasiModal(x) {
              $('.modal .modal-dialog').attr('class', 'modal-dialog  modal-dialog-centered animated ' + x);
          },
          openModal() {
              this.animasiModal(this.modal.modalOpenAnimation);
              $(`#${this.modal.id}`).modal('show');
          },
          closeModal() {
              this.animasiModal(this.modal.modalCloseAnimation);
              $(`#${this.modal.id}`).modal('hide');
          },
        }
    };
</script>