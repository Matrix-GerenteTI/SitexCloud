<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pquizz extends Model
{
    use Notifiable;
    protected $table = 'pquizz';
    public $timestamps = false;
}
