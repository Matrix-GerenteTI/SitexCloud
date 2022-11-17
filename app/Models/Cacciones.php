<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cacciones extends Model
{
    use Notifiable;

    protected $table = 'cacciones';
}
