<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Prestasi extends Model
{
    use HasApiTokens;

	// mendefinisikan nama tabel untuk model
    protected $table = 'prestasi';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = [
    	'nama', 
        'jenis', 
        'tingkat', 
        'tahun', 
        'pencapaian',
    ];

    // Mutator nama Prestasi
    public function setNamaAttribute($nama)
    {
    	$this->attributes['nama'] = ucwords($nama);
    }

    // Mutator jenis Prestasi
    public function setJenisAttribute($jenis)
    {
    	$this->attributes['jenis'] = ucwords($jenis);
    }

    // Format Tingkat pada tingkat Prestasi
    public function setTingkatAttribute($tingkat)
    {
    	$this->attributes['tingkat'] = ucwords($tingkat);
    }

    // Format Pencapaian pada pencapaian Prestasi
    public function setPencapaianAttribute($pencapaian)
    {
    	$this->attributes['pencapaian'] = ucwords($pencapaian);
    }
}
