@extends('layouts.app')

@section('content')


<div class="row ">
    <div class="col-md-16 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3 class="mb-0">Pagos realizados</h3>
                    </div>
                    <div class="">
                        <a href="{{ route('pagos.exportExcel') }}" class="btn btn-primary">Descargar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="table-info">
                        <tr >
                            <th >ID</th>
                            <th >Nombre</th>
                            <th >Monto ministrado</th>
                            <th >Cuota</th>
                            <th ># de pagos</th>
                            <th >Pagos completados</th>
                            <th >Saldo abonado</th>
                            <th >Saldo pendiente </th>
                            <th >Finalizado</th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prestamos as $prestamo)
                            <tr>
                                <td>{{ $prestamo->id}}</td>
                                <td>{{ $prestamo->client->name}}</td>
                                <td>{{ $prestamo->amount}}</td>
                                <td>{{ $prestamo->fee}}</td>
                                <td>{{ $prestamo->payments_number}}</td>
                                <td>{{ $prestamo->pagosCompletados}} </td>
                                <td>{{ $prestamo->saldoAbonado}}</td>
                                <td>{{ $prestamo->saldoPendiente}} </td>
                                <td>{{ $prestamo->finalizado}}</td>
                                <td> 
                                    <a href="{{ route('pagos.show',['id' => $prestamo->id]) }}" class="btn btn-outline-info btn-sm">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

