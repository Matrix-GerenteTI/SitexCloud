<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pdireccion extends Model
{
    use Notifiable;

    protected $connection = 'dbnomina';
    protected $table = 'pdireccion';
    public $timestamps = false;
}
