<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pactivofijos extends Model
{
    use Notifiable;

    protected $table = 'pactivofijos';
    public $timestamps = false;
}
