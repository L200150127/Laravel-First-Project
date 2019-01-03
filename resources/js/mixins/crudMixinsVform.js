export default {
  methods: {
      create(urlApi) {
          let apiPreffix = 'api/';
          let apiSuffix = urlApi.split('/').last();
          this.$validator.validateAll()
          .then( () => {
              if (!this.errors.any()) {
                  this.$Progress.start();
                  this.form.post(apiPreffix + apiSuffix)
                      .then( response => {
                          this.$emit('afterCrud');
                          $('#crudModal').modal('hide');
                          toast({
                              type: 'success',
                              title: `${ Vue.filter('capitalize')(apiSuffix) } baru berhasil ditambahkan`
                          });
                          this.$Progress.finish();
                          this.form.reset();
                      })
                      .catch( err => {
                          this.$Progress.fail();
                          this.$setErrorsFromResponse(err.response.data);
                          toast({
                              type: 'error',
                              title: `Gagal menambahkan 
                              ${ Vue.filter('capitalize')(apiSuffix) }`
                          });
                      });
              } else {
                  console.log(err);
              }
          });
      },
      read(urlApi) {
          let apiPreffix = 'api/';
          this.$Progress.start();
          axios.get(apiPreffix + urlApi)
          .then( response => {
              this.laravelData = response.data;
              this.$Progress.finish();
          })
          .catch( err => {
              this.$Progress.fail();
              console.log(err);
          });
      },
      update(urlApi) {
          let apiPreffix = 'api/';
          let apiSuffix = urlApi.split('/').last();
          this.$Progress.start();
          // Submit form melualui patch request
          this.form.patch(apiPreffix + apiSuffix + '/' + this.form.id)
              .then( response => {
                  this.$emit('afterCrud');
                  $('#crudModal').modal('hide');
                  toast({
                      type: 'success',
                      title: `Data ${ apiSuffix } berhasil diupdate`
                  });
                  this.$Progress.finish();
                  this.form.reset();
              })
              .catch( err => {
                  this.$Progress.fail();
                  toast({
                      type: 'error',
                      title: `Data ${ apiSuffix } gagal diupdate`
                  });
                  console.log(err);
              });
      },
      destroy(urlApi, id, nama) {
          swal({
              title: 'Apakah anda yakin?',
              text: 'Anda akan menghapus ' + 
                     Vue.filter('capitalize')(nama) + '!',
              type: 'warning',
              showCancelButton: true,
              showCloseButton: true,
              confirmButtonColor: '#ef7800',
              cancelButtonColor: '#dc3545',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya',
              reverseButtons: true
          })
          .then( result => {
              if (result.value) {
                  let apiPreffix = 'api/';
                  let apiSuffix = urlApi.split('/').last();
                  // Jika ya, kirim request ke server
                  this.form.delete(apiPreffix + apiSuffix + '/' + id)
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
                          'Gagal menghapus '+ Vue.filter('capitalize')(nama),
                          'error'
                      );
                  });
              }
          })
      },
      orderBy(urlApi, indexField) {
        this.$Progress.start();
        let apiPreffix = 'api/urut/';
        let apiSuffix = urlApi.split('/').last();

        axios.get(apiPreffix + apiSuffix + '?kolom=' + this.sortField[indexField][0] + '&mode=' + this.sortField[indexField][1])
        .then( response => {
            this.laravelData = response.data;
            // Attention for bug
            if (this.sortField[indexField][1] == 'asc') {
              this.sortField[indexField][1] == 'desc'
            } else {
              this.sortField[indexField][1] == 'asc'
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
          let apiPreffix = 'api/cari/';
          let apiSuffix = urlApi.split('/').last();
          this.$Progress.start();
          axios.get(apiPreffix + apiSuffix + '?q=' + query)
          .then( response => {
              this.laravelData = response.data;
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