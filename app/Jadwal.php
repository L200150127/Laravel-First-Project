<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Jadwal extends Model
{
    use HasApiTokens;

	// mendefinisikan nama tabel untuk model
    protected $table = 'jadwal';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = [
    	'id_kelas', 
    	'id_mapel', 
        'hari', 
        'jam_mulai', 
        'jam_selesai', 
        'tahun_ajaran',
    ];

    // Mutator nama Mapel
    public function setNamaAttribute($nama)
    {
        $this->attributes['nama'] = ucwords($nama);
    }

    // Mutator hari Mapel
    public function setHariAttribute($hari)
    {
        $this->attributes['hari'] = strtolower($hari);
    }

    // mendefinisikan relasi n:1 dari model ini ke model kelas, 
    public function kelas()
    {
    	return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    // mendefinisikan relasi n:1 dari model ini ke model mapel, 
    public function mapel()
    {
    	return $this->belongsTo('App\Mapel', 'id_mapel');
    }
}
