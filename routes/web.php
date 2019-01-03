<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** 
 * Route pada layer end user
 * 
 */

// Route Home
Route::get('/', function () {
    return view('guests.homepage');
});
// Route Halaman Statik Izin Operasional
Route::get('izin-operasional', function() {
    return view('guests.izin');
});
// Route Halaman Statik Janji Muhammadiyah
Route::get('janji-muhammadiyah', function() {
    return view('guests.janji');
});
// Route Halaman Visi Misi
Route::get('visi-misi', 'PageController@visiMisi');
// Route Halaman Struktur Organisasi
Route::get('struktur', 'PageController@struktur');
// Route Halaman Materi
Route::get('unduh-materi', 'PageController@materi');
// Route Halaman Galeri
Route::get('album-foto', 'PageController@albumFoto');
// Route Halaman Kontak
Route::get('kontak', 'PageController@kontak');
// Route Halaman Dana Bantuan
Route::get('dana-bantuan', 'PageController@dana');
// Route Halaman Data Guru
Route::get('data-guru', 'PageController@showGuru');
// Route Halaman Data Siswa
Route::get('data-siswa', 'PageController@ShowSiswa');
// Route Halaman Data Alumni
Route::get('data-alumni', 'PageController@ShowAlumni');
// Route Halaman Jadwal
Route::get('jadwal-kelas/{id}', 'ShowJadwal')
->where('id', '[1-6]');

/** 
 * Route untuk Tampilan Artikel pada user
 */

// Route Semua Artikel
Route::get('blog/semua', 'BlogController@index')
->name('blog.semua');
// Route Satu Artikel
Route::get('blog/{slug}', 'BlogController@single')
->where('slug', '[\w\d\-\_]+')->name('blog.single');
// Route Semua Artikel Berdasarkan kategori
Route::get('blog/kategori/{slug}', 'BlogController@showByKategori')
->where('slug', '[\w\d\-\_]+')->name('blog.kategori');
// Route Pencarian Artikel
Route::get('blog/cari/{q}', 'BlogController@search')
->name('blog.cari');



/** 
 * Route pada layer admin dan user yang telah teregisterasi
 * 
 */

// // Route Olah Agenda
// Route::resource('agenda', 'AgendaController')->except(['edit', 'create']);
// // Route Olah Artikel
// Route::resource('artikel', 'ArtikelController');
// // Route Olah Dana Bantuan
// Route::resource('dana', 'DanaController')->except(['edit', 'create']);
// // Route Olah Foto galeri
// Route::resource('foto', 'FotoController')->except(['edit', 'create']);
// // Route Olah Guru
// Route::resource('guru', 'GuruController');
// // Route Olah Kategori
// Route::resource('kategori', 'KategoriController')->except(['edit', 'create']);
// // Route Olah Kelas
// Route::resource('kelas', 'KelasController')->except(['edit', 'create']);
// // Route Olah Mapel
// Route::resource('mapel', 'MapelController')->except(['edit', 'create']);
// // Route Olah Materi
// Route::resource('materi', 'MateriController')->except(['edit', 'create']);
// // Route Olah Prestasi
// Route::resource('prestasi', 'PrestasiController')->except(['edit', 'create']);
// // Route Olah Siswa
// Route::resource('siswa', 'SiswaController');
// // Route Olah Situs
// Route::resource('situs', 'SitusController');


/** 
 * Route Login
 * 
 */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
	
Route::get('{path}', 'HomeController@index')
->where('path', '([A-z\d-\/_.]+)?');