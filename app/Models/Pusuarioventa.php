<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pusuarioventa extends Authenticatable
{
    use Notifiable;
    protected $table = 'pusuarioventa';
    protected $primaryKey = 'username';
    public $incrementing = false;
}
