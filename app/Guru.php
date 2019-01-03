<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Guru extends Model
{
    use HasApiTokens;

	// mendefinisikan nama tabel untuk model
    protected $table = 'guru';

    // mendefinisikan nama_kolom untuk mass assignment
    protected $fillable = [
    	'nip', 
    	'nama', 
    	'jenis_kelamin',
    	'alamat', 
    	'jabatan',
    	'tgl_lahir',
    	'foto',
    ];	

    // mendefinisikan objek waktu carbon untuk kolom pada tabel
    // protected $dates = ['tgl_lahir'];

    // Mutator nama Guru
    public function setNamaAttribute($nama)
    {
        $this->attributes['nama'] = ucwords($nama);
    }

    // Mutator jeni_kelamin Guru
    public function setJenisKelaminAttribute($jenis_kelamin)
    {
        $this->attributes['jenis_kelamin'] = strtoupper($jenis_kelamin);
    }

    // mendefinisikan relasi 1:n dari model ini ke model kelas
    public function kelas()
    {
    	return $this->hasMany('App\Kelas', 'wali_kelas');
    }

    // mendefinisikan relasi n:n dari model ini ke model mapel menggunakan 
    // tabel guru_mapel
    public function mapel()
    {
    	return $this->belongsToMany('App\Mapel', 'guru_mapel', 'id_guru', 
            'id_mapel');
    }
}
