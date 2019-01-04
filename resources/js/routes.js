// Membuat Routing
export default [{
        path: '/home',
        name: 'home',
        component: require('./views/admin/Home.vue'),
        meta: {
            title: 'Dashboard Admin',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Dashboard Admin MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Dashboard Admin MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/users',
        name: 'users',
        component: require('./views/admin/Users.vue'),
        meta: {
            title: 'Manajemen User',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Manajemen User MIM Pucangan'
                }, ,
                {
                    property: 'og:description',
                    content: 'Halaman Manajemen User MIM Pucangan'
                }
            ]

        }
    },
    {
        path: '/profil',
        name: 'profil',
        component: require('./views/admin/Profil.vue'),
        meta: {
            title: 'Profil',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Profil'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Profil'
                }
            ]
        }
    },
    {
        path: '/artikel',
        name: 'artikel',
        component: require('./views/admin/Artikel.vue'),
        meta: {
            title: 'Artikel Sekolah',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Artikel Sekolah MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Artikel Sekolah MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/artikel-tambah',
        name: 'tambahartikel',
        component: require('./views/admin/Tambah-Artikel.vue'),
        meta: {
            title: 'Artikel Baru',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Buat Artikel MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Buat Artikel MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/artikel-ubah/:id',
        name: 'editartikel',
        component: require('./views/admin/Edit-Artikel.vue'),
        meta: {
            title: 'Edit Artikel',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Edit Artikel MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Edit Artikel MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/guru',
        name: 'guru',
        component: require('./views/admin/Guru.vue'),
        meta: {
            title: 'Manajemen Data Guru',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Manajemen Data Guru MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Manajemen Data Guru MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/guru-tambah',
        name: 'tambahguru',
        component: require('./views/admin/Tambah-Guru.vue'),
        meta: {
            title: 'Tambah Data Guru',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Tambah Data Guru MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Tambah Data Guru MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/guru-ubah/:id',
        name: 'editguru',
        component: require('./views/admin/Edit-Guru.vue'),
        meta: {
            title: 'Edit Data Guru',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Edit Data Guru MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Edit Data Guru MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/siswa',
        name: 'siswa',
        component: require('./views/admin/Siswa.vue'),
        meta: {
            title: 'Manajemen Data Siswa',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Manajemen Data Siswa MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Manajemen Data Siswa MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/siswa-tambah',
        name: 'tambahsiswa',
        component: require('./views/admin/Tambah-Siswa.vue'),
        meta: {
            title: 'Tambah Data Siswa',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Tambah Data Siswa MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Tambah Data Siswa MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/siswa-ubah/:id',
        name: 'editsiswa',
        component: require('./views/admin/Edit-Siswa.vue'),
        meta: {
            title: 'Edit Data Siswa',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Edit Data Siswa MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Edit Data Siswa MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/alumni',
        name: 'alumni',
        component: require('./views/admin/Alumni.vue'),
        meta: {
            title: 'Daftar Alumni',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Daftar Alumni MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Daftar Alumni MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/kelas',
        name: 'kelas',
        component: require('./views/admin/Kelas.vue'),
        meta: {
            title: 'Manajemen Kelas',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Kelas MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Kelas MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/jadwal',
        name: 'jadwal',
        component: require('./views/admin/Jadwal.vue'),
        meta: {
            title: 'Jadwal Pelajaran',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Jadwal Pelajaran MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Jadwal Pelajaran MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/materi',
        name: 'materi',
        component: require('./views/admin/Materi.vue'),
        meta: {
            title: 'Materi Pendukung Pembelajaran',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Materi Pendukung Pembelajaran MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Materi Pendukung Pembelajaran MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/prestasi',
        name: 'prestasi',
        component: require('./views/admin/Prestasi.vue'),
        meta: {
            title: 'Prestasi Sekolah',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Prestasi Sekolah MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Prestasi Sekolah MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/galeri',
        name: 'galeri',
        component: require('./views/admin/Galeri.vue'),
        meta: {
            title: 'Galeri Foto Sekolah',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Galeri Foto Sekolah MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Galeri Foto Sekolah MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/agenda',
        name: 'agenda',
        component: require('./views/admin/Agenda.vue'),
        meta: {
            title: 'Agenda Sekolah',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Agenda Sekolah MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Agenda Sekolah MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/dana_bantuan',
        name: 'danabantuan',
        component: require('./views/admin/Dana.vue'),
        meta: {
            title: 'Dana Bantuan Sekolah',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Manajemen Dana Bantuan Sekolah MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Manajemen Dana Bantuan Sekolah MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/pengaturan',
        name: 'pengaturan',
        component: require('./views/admin/Setting.vue'),
        meta: {
            title: 'Pengaturan Website',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Pengaturan Website MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Pengaturan Website MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '/bantuan',
        name: 'bantuan',
        component: require('./views/admin/Bantuan.vue'),
        meta: {
            title: 'Menu Bantuan',
            metaTags: [{
                    name: 'description',
                    content: 'Halaman Menu Bantuan Website MIM Pucangan'
                },
                {
                    property: 'og:description',
                    content: 'Halaman Menu Bantuan Website MIM Pucangan'
                }
            ]
        }
    },
    {
        path: '*',
        component: require('./views/Error-404.vue')
    },
];
