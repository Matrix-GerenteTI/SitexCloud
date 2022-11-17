<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cquizznivel extends Model
{
    use Notifiable;

    protected $table = 'cquizznivel';
    public $timestamps = false;
}
