<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Csucursal extends Model
{
    use Notifiable;

    protected $table = 'csucursal';
}
