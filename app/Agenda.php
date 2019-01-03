<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Agenda extends Model
{
    use HasApiTokens;

	// mendefinisikan nama tabel untuk model
    protected $table = 'agenda';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = [
    	'nama', 'jenis', 'deskripsi', 'warna', 'tgl_mulai', 'tgl_selesai',
    ];

    // mendefinisikan objek waktu carbon untuk kolom pada tabel
    // protected $dates = ['tgl_mulai', 'tgl_selesai'];

    // Mutator nama Agenda
    public function setNamaAttribute($nama)
    {
        $this->attributes['nama'] = ucwords($nama);
    }

    // Mutator jenis Agenda
    public function setJenisAttribute($jenis)
    {
        $this->attributes['jenis'] = strtolower($jenis);
    }

}
