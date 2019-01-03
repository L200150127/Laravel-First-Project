<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Dana extends Model
{
    use HasApiTokens;

    // mendefinisikan nama tabel untuk model
    protected $table = 'dana';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = [
    	'nama', 'jenis', 'jumlah', 'sumber', 'semester', 'tanggal'
    ];

    // mendefinisikan objek waktu carbon untuk kolom pada tabel
    // protected $dates = ['tanggal'];

    // Accessor jenis Dana
    public function getNamaAttribute($nama)
    {
        return ucwords($nama);
    }


    // Accessor jenis Dana
    public function getJenisAttribute($jenis)
    {
        return ucwords($jenis);
    }

    // Accessor sumber Dana
    public function getSumberAttribute($sumber)
    {
        return ucwords($sumber);
    }
    
    // Mutator nama Dana
    public function setNamaAttribute($nama)
    {
        $this->attributes['nama'] = strtolower($nama);
    }
    
    // Mutator jenis Agenda
    public function setJenisAttribute($jenis)
    {
        $this->attributes['jenis'] = strtolower($jenis);
    }

    // Mutator sumber Dana
    public function setSumberAttribute($sumber)
    {
        $this->attributes['sumber'] = ucwords($sumber);
    }

}
