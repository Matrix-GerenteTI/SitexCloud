<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ctiposangre extends Model
{
    use Notifiable;

    protected $connection = 'dbnomina';
    protected $table = 'ctiposangre';
}
