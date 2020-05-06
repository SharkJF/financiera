<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'client_id',
        'cantidad',
        'NumPagos',
        'total',
        'fMinistracion',
        'fVencimento'
    ];
}
