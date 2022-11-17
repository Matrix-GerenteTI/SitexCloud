<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cquizzpregunta extends Model
{
    use Notifiable;

    protected $table = 'cquizzpregunta';
    public $timestamps = false;
}
