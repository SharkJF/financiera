<?php

namespace App\Exports;
use App\models\Client;
use App\models\Prestamo;
use App\models\PagosRealizados;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutosize;

class Exportar implements fromCollection, withHeadings, WithMapping, ShouldAutosize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $prestamo = Prestamo::with('client')->get();

        return $prestamo;
    }
    public function map($prestamo):array
    {
        return[
            $prestamo->id,
            $prestamo->client->name,
            $prestamo->amount,
            $prestamo->payments_number,
            $prestamo->fee,
            $prestamo->pagosCompletados,
            $prestamo->saldoAbonado,
            $prestamo->saldoPendiente,
            $prestamo->finalizado,
        ];
    }
    public function headings():array
    {
        return[
            '#',
            'Nombre',
            'Cantidad',
            'No. de Pagos',
            'Cuota',
            'Pagos Hechos',
            'Saldo abonado',
            'Saldo pendiente',
            'Finalizado',
        ];
    }
}

?>