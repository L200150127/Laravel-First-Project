export default {
    methods: {
        getResults(page = 1) {
            if (page == this.laravelData.meta.current_page) {
                return;
            }
            this.$Progress.start();
            let kolom = (this.kolom) ? '?kolom=' + this.kolom : '';
            let mode = (this.mode) ? '&mode=' + this.mode : '';
            let query = (this.query) ? '?q=' + this.query : '';
            let halaman = (this.kolom || this.query) ? '&page=' + page : '?page=' + page;
            if (this.query) {
                axios.get(this.laravelData.meta.path + query + halaman)
                    .then( response => {
                        this.laravelData = response.data;
                        this.$Progress.finish();
                    });
            } else {
                axios.get(this.laravelData.meta.path + kolom + mode + halaman)
                    .then( response => {
                        this.laravelData = response.data;
                        this.$Progress.finish();
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
                                $('#crudModal').modal('hide');
                                this.$Progress.finish();
                                this.$nextTick(() => {
                                    this.clearForm();
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
                        axios.delete(`${urlApi}/${id}`)
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
            this.query = query;
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
        updateFile(e) {
            let file = e.target.files[0];
            this.fileLabel = _.truncate( file.name, {
                'length': 50,
            });
            let reader = new FileReader();
            if (file['size'] < 4096000) {
                this.form.file = file;
            } else {
                swal({
                    type: 'error',
                    title: 'Ups...',
                    text: 'Ukuran file harus dibawah 4MB',
                });
            }
        },
    }
}