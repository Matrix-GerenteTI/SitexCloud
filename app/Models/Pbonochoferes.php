<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pbonochoferes extends Model
{
    use Notifiable;

    protected $table = 'pbonochoferes';
    public $timestamps = false;
}
