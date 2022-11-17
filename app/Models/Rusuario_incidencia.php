<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Rusuario_incidencia extends Model
{
    use Notifiable;
    protected $table = 'rusuario_incidencia';
    public $timestamps = false;
}
