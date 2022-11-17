<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pusuariosucursal extends Model
{
    use Notifiable;
    protected $connection = 'dbnomina';
    protected $table = 'pusuariosucursal';
    public $timestamps = false;
}
