<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cautos_modelo extends Model
{
    use Notifiable;

    protected $table = 'cautos_modelo';
    public $timestamps = false;
}
