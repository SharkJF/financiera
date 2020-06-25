@extends('layouts.app')

@section('content')


<div class="row ">
    <div class="col-md-8 mx-auto my-3">
        <div class="row mb-2 ">
            <div class="col-md-12 col-lg-6 mb-sm-4 ">
                <div class="card">
                <div class="card-header">
                <a class="h3">{{ $prestamos->client->name }}</a>
                </div>
                    <div class="card-body card-block-body">
                        <ul class="list-unstyled">
                            <li class="lead"><strong>Saldo abonado: </strong> $  {{ $prestamos->saldoAbonado}} </li>
                            <li class="lead"><strong>Saldo pendiente: </strong> $ {{ $prestamos->saldoPendiente }} </li>
                        </ul>
                    <a href="{{ route('pagos.action',['id' => $prestamos->id]) }}" class="btn btn-outline-success btn-block">Abonar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-info text-white">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3 class="mb-0">Tabla de pagos</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead >
                        <tr class="" >
                            <th>Número de pago</th>
                            <th>Cuota</th>
                            <th>Abonado</th>
                            <th>Fecha de pago</th>
                            <th>Fecha de abono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prestamos->pagosOrderBy as $pagos) 
                            <tr>
                                <td>{{ $pagos->number }}</td>
                                <td>{{ $pagos->amount }}</td>
                                <td>{{ $pagos->received_amount }}</td>
                                <td>{{ $pagos->payment_date }}</td>
                                <td>{{ $pagos->receipt_date}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


