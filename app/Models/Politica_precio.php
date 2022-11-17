<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Politica_precio extends Model
{
    use Notifiable;
    public $timestamps = false;
    //protected $connection = 'prediction';
    protected $table = 'politica_precios';
}
