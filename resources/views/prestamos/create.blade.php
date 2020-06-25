@extends('layouts.app')

@section('content')
<div class="row  ">
    <div class="col-sm-8 col-md-8 col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3>Nuevo prestamo</h3>
                    </div>
                    <div class="">
                        <a href="{{ route('prestamos.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('prestamos.store') }}">
                    @csrf
                    <div class="form-group form-row">
                        <div class=" col-md-6">
                            <label>Cliente</label>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                  <label class="input-group-text">Nombre</label>
                                </div>
                                <select class="custom-select @error('client_id') is-invalid @enderror" name="client_id">
                                    @foreach ($names as $key=>$id)
                                        <option value="{{$id}}">{{ $key }}</option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Cantidad</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">$</label>
                                  </div>
                                <input type="number" name="amount" id="amount" type="text"class="form-control @error('amount') is-invalid @enderror">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="payments_number">Número de pagos</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">#</label>
                                  </div>
                                <input type="number" name="payments_number" id="payments_number" class="form-control">
                                @error('amount')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Cuota</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">$</label>
                                  </div>
                                <input type="number" name="fee" id="fee" type="text"class="form-control @error('fee') is-invalid @enderror">
                                @error('fee')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-12">
                            <label for="ministry_date">Fecha de ministración</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Fecha</label>
                                  </div>
                                <input type="date" name="ministry_date" id="ministry_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input class="btn btn-success btn-block bg-green" type="submit" value="Realizar">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
