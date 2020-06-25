<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name',
        'phone',
        'address'
    ];

    public function prestamos()
    {
        return $this->hasMany('App\models\Prestamo');
    }

}