<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ptickets extends Model
{
    use Notifiable;
    protected $connection = 'firebird';
    protected $table = 'CFG_ALMACENES';

}
