<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cparametrosasistencia extends Model
{
    use Notifiable;

    protected $table = 'cparametrosasistencia';
    public $timestamps = false;

    protected $fillable = [ 
        'iddepartamento', 
        'idpuesto',
        'idsucursal',
        'idempleado',
        'entrada',
        'salida',
        'entradai',
        'salidai',
        'tolerancia',
        'toleranciafalta',
        'retardospfalta',
        'faltaspdescuento',
        'corrido',
        'status',
    ];
}
