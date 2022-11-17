<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ctipoticket extends Model
{
    use Notifiable;

    protected $table = 'ctipoticket';
}
