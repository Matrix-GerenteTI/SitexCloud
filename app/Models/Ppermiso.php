<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ppermiso extends Model
{
    use Notifiable;
    protected $table = 'ppermiso';
    public $timestamps = false;
}
