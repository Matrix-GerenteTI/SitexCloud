<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pempleado extends Model
{
    use Notifiable;
    protected $connection = 'dbnomina';
    protected $primaryKey = 'nip';
    protected $table = 'pempleado';
    public $timestamps = false;
}
