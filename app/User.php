<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'bio', 
        'photo', 
        'type'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->attributes['type'] == 'admin';
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->attributes['type'] == 'admin';
    }


    // mendefinisikan relasi 1:n dari model ini ke model artikel
    public function artikel()
    {
        return $this->hasMany('App\Artikel', 'id_user');
    }

    // hash a password before saving
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
