<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situs extends Model
{
	// mendefinisikan nama tabel untuk model
    protected $table = 'informasi_sekolah';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = [
    	'nama', 
    	'deskripsi', 
    	'isi', 
    	'path',
    ];
}
