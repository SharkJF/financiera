<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagosRealizados extends Model
{
    protected $fillable = [
        'client_id',
        'prestamos_id',
        'cantidad'
    ];
}
