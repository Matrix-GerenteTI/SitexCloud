<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pinventario_excepciones extends Model
{
    use Notifiable;

    protected $connection = 'dbnomina';
    protected $table = 'inventario_excepciones';
    public $timestamps = false;
}
