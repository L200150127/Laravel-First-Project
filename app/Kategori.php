<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Kategori extends Model
{
    use HasApiTokens;
    
    // mendefinisikan nama tabel untuk model
    protected $table = 'kategori';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = ['nama', 'slug'];
    
    // Mutator nama Kategori
    public function setNamaAttribute($nama)
    {
        $this->attributes['nama'] = ucwords($nama);
    }

    // mendefinisikan relasi 1:n dari model ini ke model artikel
    public function artikel()
    {
    	return $this->hasMany('App\Artikel', 'id_kategori');
    }
}
