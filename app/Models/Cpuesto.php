<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cpuesto extends Model
{
    use Notifiable;

    protected $connection = 'dbnomina';
    protected $table = 'cpuesto';
}
