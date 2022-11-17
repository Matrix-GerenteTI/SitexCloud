<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cambios_adscripcion extends Model
{
    use Notifiable;

    protected $table = 'cambios_adscripcion';
    public $timestamps = false;
}
