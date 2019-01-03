<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Mapel extends Model
{
    use HasApiTokens;

	// mendefinisikan nama tabel untuk model
    protected $table = 'mapel';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = ['nama'];


    // Mutator nama Mapel
    public function setNamaAttribute($nama)
    {
        $this->attributes['nama'] = ucwords($nama);
    }

    // mendefinisikan relasi 1:n dari model ini ke model materi
    public function materi()
    {
    	return $this->hasMany('App\Materi', 'id_mapel');
    }

    // mendefinisikan relasi 1:n dari model ini ke model materi
    public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'id_mapel');
    }

    // mendefinisikan relasi n:n dari model ini ke model guru menggunakan 
    // tabel guru_mapel
    public function guru()
    {
        return $this->belongsToMany('App\Guru', 'guru_mapel', 'id_mapel', 
            'id_guru');
    }
}
