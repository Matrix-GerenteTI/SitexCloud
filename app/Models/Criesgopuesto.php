<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Criesgopuesto extends Model
{
    use Notifiable;

    protected $connection = 'dbnomina';
    protected $table = 'criesgopuesto';
}
