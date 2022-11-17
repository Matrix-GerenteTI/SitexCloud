<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ctipojornada extends Model
{
    use Notifiable;

    protected $connection = 'dbnomina';
    protected $table = 'ctipojornada';
}
