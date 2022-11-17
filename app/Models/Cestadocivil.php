<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cestadocivil extends Model
{
    use Notifiable;

    protected $connection = 'dbnomina';
    protected $table = 'cestadocivil';
}
