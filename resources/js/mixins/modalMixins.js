export default {
    methods: {
        closeModal(idSelector, animasi) {
            this.animasiModal(animasi);
            $(`#${idSelector}`).modal('hide');
        },
        openModal(idSelector, animasi) {
            this.animasiModal(animasi);
            $(`#${idSelector}`).modal('show');
        },
        animasiModal(x) {
            $('.modal .modal-dialog').attr('class', 'modal-dialog  modal-dialog-centered animated ' + x);
        },
    }
}
