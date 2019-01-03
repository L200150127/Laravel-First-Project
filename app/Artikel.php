<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Artikel extends Model
{
    use HasApiTokens;
	// mendefinisikan nama tabel untuk model
    protected $table = 'artikel';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = [
    	'judul', 'isi', 'slug', 'gambar_cover', 'id_kategori', 'id_user',
    ];

    // mendefinisikan relasi n:1 dari model ini ke model kategori, 
    public function kategori()
    {
    	return $this->belongsTo('App\Kategori', 'id_kategori');
    }

    // mendefinisikan relasi n:1 dari model ini ke model user, 
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
