<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'dbnomina';
    protected $table = 'pusuarios';
    protected $primaryKey = 'username';
    public $incrementing = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function permisos()
    {
        return $this->hasMany('App\Models\Ppermiso', 'idusuario', 'idempleado');
    }

    protected $hidden = [
        'password'
    ];

 
}
