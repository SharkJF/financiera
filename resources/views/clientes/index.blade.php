@extends('layouts.app')

@section('content')
<div class="row ">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3 class="mb-0">Cliente</h3>
                    </div>
                    <div class="">
                        <a href="{{ route('clientes.create') }}" class="btn btn-primary">Nuevo</a>
                        <a href="{{ route('clientes.import') }}" class="btn btn-primary">Cargar clientes</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
               
                <table class="table mx-left">
                    
                    <thead class="table-info">
                        <tr>
                            <th scope="col">#</th>
                            <th >Nombre</th>
                            <th >Telefono</th>
                            <th scope="col" >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td scope="row">{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>
                                    <a href="{{ route('clientes.edit',$client->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                    <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{ $client->id }}" >Borrar</button>
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
                axios.delete('{{ route('clientes.index') }}/'+ id, options)  
                    .then(result => {
                        Swal.fire({
                            title: 'Borrado',
                            text: 'El cliente a sido borrado',
                            icon: 'success'
                        }).then(() => {
                            window.location.href='{{ route('clientes.index') }}';
                        });
                    })
                    .catch(error => {
                        Swal.fire(
                            'Ocurrió un error',
                            'El cliente no ha podido borrarse.',
                            'error'
                        );
                    });
            }
        });
    });
</script>

<script>
    $('#alert').fadeIn();     
  setTimeout(function() {
       $("#alert").fadeOut();           
  },2000);
</script>
@endsection