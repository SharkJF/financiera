@extends('layouts.app')

@section('content')
<div class="row ">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3 class="mb-0">Prestamos</h3>
                    </div>
                    <div class="">
                        <a href="{{ route('prestamos.create') }}" class="btn btn-primary">Nuevo prestamo</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="table-info">
                        <tr>
                            <th>ID</th>
                            <th >Nombre</th>
                            <th >Cantidad</th>
                            <th ># de pagos</th>
                            <th >Cuota</th>
                            <th >Fecha de ministración </th>
                            <th >Fecha de vencimiento </th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($prestamos as $prestamo)
                            <tr>
                                <td> {{ $prestamo->id }}</td>
                                <td>{{ $prestamo->client->name }}</td>
                                <td>{{ $prestamo->amount }}</td>
                                <td>{{ $prestamo->payments_number}}</td>
                                <td>{{ $prestamo->fee }}</td>
                                <td>{{ $prestamo->ministry_date }}</td>
                                <td>{{ $prestamo->due_date }}</td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{ $prestamo->id }}" >Borrar</button>
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

@section('bottom-js')
<script>
    $('body').on('click', '.btn-delete', function(event) {
        const id = $(this).data('id');

        const options = {
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        };

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'No podrás revertir esta acción',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borralo!'
        })
        .then((result) => {
            if (result.value) {
                axios.delete('{{ route('prestamos.index') }}/'+ id, options)  
                    .then(result => {
                        Swal.fire({
                            title: 'Borrado',
                            text: 'El prestamo ha sido borrado',
                            icon: 'success'
                        }).then(() => {
                            window.location.href='{{ route('prestamos.index') }}';
                        });
                    })
                    .catch(error => {
                        Swal.fire(
                            'Ocurrió un error',
                            'El prestamo no ha podido borrarse.',
                            'error'
                        );
                    });
            }
        });
    });
</script>
@endsection

