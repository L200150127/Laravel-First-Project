<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Siswa extends Model
{
    use HasApiTokens;

	// mendefinisikan nama tabel untuk model
    protected $table = 'siswa';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = [
    	'nis', 
    	'nisn', 
    	'nama', 
    	'alamat', 
    	'jenis_kelamin',
    	'tgl_lahir',
    	'foto',
    	'status',
    	'tahun_masuk',
    	'tahun_lulus',
    ];

    // mendefinisikan objek waktu carbon untuk kolom pada tabel
    // protected $dates = ['tgl_lahir'];

    // protected $casts = [
    //     'nis' => 'string',
    // ];


    // Mutator nama Siswa
    public function setNamaAttribute($nama)
    {
        $this->attributes['nama'] = ucwords($nama);
    }

    // Mutator jeni_kelamin Siswa
    public function setJenisKelaminAttribute($jenis_kelamin)
    {
        $this->attributes['jenis_kelamin'] = strtoupper($jenis_kelamin);
    }
}
