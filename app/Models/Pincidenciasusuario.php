<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pincidenciasusuario extends Model
{
    use Notifiable;

    protected $table = 'pincidenciasusuario';
    public $timestamps = false;
}
