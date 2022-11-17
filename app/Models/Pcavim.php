<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pcavim extends Model
{
    use Notifiable;

    protected $table = 'pcavim';
    public $timestamps = false;
}
