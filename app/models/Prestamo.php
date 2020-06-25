<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'client_id',
        'amount',
        'payments_number',
        'fee',
        'ministry_date',
        'due_date',
        'finished'
    ];
    public function client()
    {
        return $this->belongsTo('App\models\Client');
    }

    public function pagos()
    {
        return $this->hasMany('App\models\PagosRealizados');
    }

    public function pagosOrderBy()
    {
        return $this->hasMany('App\models\PagosRealizados')->orderBy('id', 'asc');
    }
    public function getSaldoAbonadoAttribute()
    {
        return $this->pagos()->sum('received_amount');
    }

    public function getSaldoPendienteAttribute()
    {
        $saldoPendiente = $this->pagos()->sum('amount') - $this->saldoAbonado;
        return $saldoPendiente;
    }

    public function getPagosCompletadosAttribute()
    {
        return $this->pagos()->where('paid',1)->count();   
    }
    public function getFinalizadoAttribute()
    {
        $saldoPendiente = $this->pagos()->sum('amount') - $this->saldoAbonado;
        if($saldoPendiente == 0)
        {
            $finalizado = "OK";
            return $finalizado;
        }else
        {
            $finalizado = "--";
            return $finalizado;
        }
    }
}
