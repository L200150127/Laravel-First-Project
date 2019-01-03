export default {
    methods: {
        create(urlApi) {
            let apiSuffix = urlApi.split('/').last();
            this.$validator.validateAll()
                .then(() => {
                    if (!this.errors.any()) {
                        this.$Progress.start();
                        this.form.post(urlApi)
                            .then( response => {
                                this.$emit('afterCrud');
                                toast({
                                    type: 'success',
                                    title: `${ Vue.filter('capitalize')(apiSuffix) } baru berhasil ditambahkan`
                                });
                                $('#crudModal').modal('hide');
                                this.$Progress.finish();
                                this.$nextTick(() => {
                                    this.$validator.reset();
                                    this.form.reset();
                                })
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
        read(urlApi) {
            this.$Progress.start();
            axios.get(urlApi)
                .then( response => {
                    this.laravelData = response.data;
                    this.$Progress.finish();
                })
                .catch(err => {
                    this.$Progress.fail();
                    console.log(err);
                });
        },
        update(urlApi) {
            let apiSuffix = urlApi.split('/').last();
            this.$validator.validateAll()
                .then(() => { 
                    if (!this.errors.any()) {
                        this.$Progress.start();
                        this.form.patch(`${urlApi}/${this.form.id}`)
                            .then( response => {
                                this.$emit('afterCrud');
                                toast({
                                    type: 'success',
                                    title: `Data ${ apiSuffix } berhasil diupdate`
                                });
                                $('#crudModal').modal('hide');
                                this.$Progress.finish();
                                this.$nextTick(() => {
                                    this.$validator.reset();
                                    this.form.reset();
                                })
                                // this.errors.clear()
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
                });
            
        },
        destroy(urlApi, id, ...nama) {
            let apiSuffix = urlApi.split('/').last();
            let hari = (nama[2]) ? ', ' : '';
            swal({
                    title: 'Apakah anda yakin?',
                    text: _.trim(`Anda akan menghapus
                    ${apiSuffix} ${Vue.filter('capitalize')(nama[0])}
                    ${Vue.filter('capitalize')(nama[1])}${hari} 
                    ${Vue.filter('capitalize')(nama[2])}`),
                    type: 'warning',
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonColor: '#ef7800',
                    cancelButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya',
                    reverseButtons: true
                })
                .then(result => {
                    if (result.value) {
                        this.$Progress.start();
                        this.form.delete(`${urlApi}/${id}`)
                            .then( response => {
                                swal(
                                    'Berhasil!',
                                    Vue.filter('capitalize')(nama) +
                                    ' berhasil dihapus.',
                                    'success'
                                )
                                this.$emit('afterCrud');
                            })
                            .catch(() => {
                                this.$Progress.fail();
                                swal(
                                    'Gagal',
                                    'Gagal menghapus ' + 
                                    Vue.filter('capitalize')(nama),
                                    'error'
                                );
                            });
                    }
                })
        },
        orderBy(urlApi, indexField) {
            this.$Progress.start();
            this.kolom = this.sortField[indexField][0];
            this.mode = this.sortField[indexField][1];
            axios.get(`${urlApi}?
              kolom=${this.sortField[indexField][0]}&
              mode=${this.sortField[indexField][1]}`)
                .then( response => {
                    this.laravelData = response.data;
                    if (this.sortField[indexField][1] == 'asc') {
                        this.sortField[indexField][1] = 'desc';
                    } else {
                        this.sortField[indexField][1] = 'asc';
                    }
                    this.$Progress.finish();
                })
                .catch(() => {
                    swal(
                        'Gagal',
                        'Gagal dalam mengurutkan data',
                        'error'
                    );
                });
        },
        search(urlApi, query) {
            // let apiPreffix = 'api/cari/';
            // let apiSuffix = urlApi.split('/').last();
            this.$Progress.start();
            axios.get(`${urlApi}?q=${query}`)
                .then( response => {
                    this.laravelData = response.data;
                    this.$parent.search = '';
                    this.$Progress.finish();
                })
                .catch(() => {
                    swal(
                        'Gagal',
                        'Gagal dalam melakukan pencarian',
                        'error'
                    );
                });
        },
    }
}
