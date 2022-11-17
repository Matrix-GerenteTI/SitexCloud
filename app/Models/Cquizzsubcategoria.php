<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cquizzsubcategoria extends Model
{
    use Notifiable;

    protected $table = 'cquizzsubcategoria';
    public $timestamps = false;
}
