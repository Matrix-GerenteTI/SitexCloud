<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pusuarios extends Model
{
    protected $connection = 'dbnomina';
    protected $table = 'pusuarios';
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $timestamps = false;
}
