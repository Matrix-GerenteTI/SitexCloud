<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cquizzclasificacion extends Model
{
    use Notifiable;

    protected $table = 'cquizzclasificacion';
    public $timestamps = false;
}
