<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Foto extends Model
{
    use HasApiTokens;
    
    // mendefinisikan nama tabel untuk model
    protected $table = 'foto';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = [
    	'nama', 'deskripsi', 'path', 'ukuran'
    ];

    // Accessor nama Kategori
    public function getNamaAttribute($nama)
    {
    	return ucwords($nama);
    }

    // Mutator nama Kategori
    public function setNamaAttribute($nama)
    {
        $this->attributes['nama'] = ucwords($nama);
    }
}
