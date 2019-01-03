<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Kelas extends Model
{
    use HasApiTokens;

	// mendefinisikan nama tabel untuk model
    protected $table = 'kelas';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = ['nama', 'wali_kelas'];

    // Mutator nama Kelas
    public function setNamaAttribute($nama)
    {
    	$this->attributes['nama'] = ucwords($nama);
    }

    // mendefinisikan relasi 1:n dari model ini ke model materi
    public function materi()
    {
    	return $this->hasMany('App\Materi', 'id_kelas');
    }

    // mendefinisikan relasi 1:n dari model ini ke model jadwal
    public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'id_kelas');
    }

    // mendefinisikan relasi n:1 dari model ini ke model guru, 
    public function guru()
    {
    	return $this->belongsTo('App\Guru', 'wali_kelas');
    }
}
