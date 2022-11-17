<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Presguardo extends Model
{
    use Notifiable;
    protected $table = 'presguardos';
    public $timestamps = false;
}
