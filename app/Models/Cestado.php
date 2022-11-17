<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cestado extends Model
{
    use Notifiable;

    protected $connection = 'dbnomina';
    protected $table = 'cestado';
    public $incrementing = false;
}
