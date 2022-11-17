<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pcontrato extends Model
{
    use Notifiable;

    protected $connection = 'dbnomina';
    protected $table = 'pcontrato';
    public $timestamps = false;
}
