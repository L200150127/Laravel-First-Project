<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Materi extends Model
{
    use HasApiTokens;

	// mendefinisikan nama tabel untuk model
    protected $table = 'materi';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = [
    	'nama', 
        'path', 
        'id_kelas', 
        'id_mapel',
    ];

    // Mutator nama Materi
    public function setNamaAttribute($nama)
    {
        $this->attributes['nama'] = ucwords($nama);
    }

    // mendefinisikan relasi n:1 dari model ini ke model kelas, 
    public function kelas()
    {
    	return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    // mendefinisikan relasi n:1 dari model ini ke model guru, 
    public function mapel()
    {
    	return $this->belongsTo('App\Mapel', 'id_mapel');
    }
}
