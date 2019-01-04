<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** 
 * Route pada layer admin dan user yang telah teregisterasi
 * 
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Membuat Semua API Route Resource yang dibutuhkan
Route::apiResources([
	'artikel'  => 'API\ArtikelController',
	'guru'     => 'API\GuruController',
	'siswa'    => 'API\SiswaController',
]);
Route::apiResource('kelas', 'API\KelasController')->parameters([
    'kelas' => 'kelas'
])->except(['show']);

// Membuat Semua Parsial API Route Resource yang dibutuhkan
Route::apiResource('agenda', 'API\AgendaController')->except(['show']);
Route::apiResource('dana', 'API\DanaController')->except(['show']);
Route::apiResource('foto', 'API\FotoController')->except(['show']);
Route::apiResource('jadwal', 'API\JadwalController')->except(['show']);
Route::apiResource('kategori', 'API\KategoriController')->except(['show']);
Route::apiResource('mapel', 'API\MapelController')->except(['show']);
Route::apiResource('materi', 'API\MateriController')->except(['show']);
Route::apiResource('prestasi', 'API\PrestasiController')->except(['show']);
Route::apiResource('situs', 'API\SitusController')->except(['show']);
Route::apiResource('user', 'API\UserController')->except(['show']);
Route::get('profil', 'API\ProfilController@show');
Route::patch('profil', 'API\ProfilController@update');
Route::get('alumni', 'API\SiswaController@alumni');

// Route List data untuk select box
Route::get('list-guru', 'API\GuruController@getListGuru');
Route::get('list-kelas', 'API\KelasController@getListKelas');
Route::get('list-mapel', 'API\MapelController@getListMapel');

// Route semua data agenda
Route::get('semua-agenda', 'API\AgendaController@getAll');


// Route Pengurutan Data
Route::get('urut/alumni', 'API\SiswaController@orderByAlumni')
->name('alumni.urut');
Route::get('urut/artikel', 'API\ArtikelController@orderBy')
->name('artikel.urut');
Route::get('urut/dana', 'API\DanaController@orderBy')
->name('dana.urut');
Route::get('urut/guru', 'API\GuruController@orderBy')
->name('guru.urut');
Route::get('urut/jadwal', 'API\JadwalController@orderBy')
->name('jadwal.urut');
Route::get('urut/mapel', 'API\MapelController@orderBy')
->name('mapel.urut');
Route::get('urut/materi', 'API\MateriController@orderBy')
->name('materi.urut');
Route::get('urut/prestasi', 'API\PrestasiController@orderBy')
->name('prestasi.urut');
Route::get('urut/siswa', 'API\SiswaController@orderBy')
->name('siswa.urut');
Route::get('urut/user', 'API\UserController@orderBy')
->name('user.urut');

// Route Pencarian Data
Route::get('cari/alumni', 'API\SiswaController@searchAlumni')
->name('alumni.cari');
Route::get('cari/artikel', 'API\ArtikelController@search')
->name('artikel.cari');
Route::get('cari/dana', 'API\DanaController@search')
->name('dana.cari');
Route::get('cari/foto', 'API\FotoController@search')
->name('foto.cari');
Route::get('cari/guru', 'API\GuruController@search')
->name('guru.cari');
Route::get('cari/jadwal', 'API\JadwalController@search')
->name('jadwal.cari');
Route::get('cari/kategori', 'API\KategoriController@search')
->name('kategori.cari');
Route::get('cari/mapel', 'API\MapelController@search')
->name('mapel.cari');
Route::get('cari/materi', 'API\MateriController@search')
->name('materi.cari');
Route::get('cari/prestasi', 'API\PrestasiController@search')
->name('prestasi.cari');
Route::get('cari/siswa', 'API\SiswaController@search')
->name('siswa.cari');
Route::get('cari/user', 'API\UserController@search')
->name('user.cari');
