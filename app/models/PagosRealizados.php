<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PagosRealizados extends Model
{
    protected $fillable = [
        'client_id',
        'prestamo_id',
        'number',
        'amount',
        'payment_date',
        'received_amount',
    ];
    public function prestamo(){
        return $this->belongsTo('App\models\Prestamo');
    }
}
