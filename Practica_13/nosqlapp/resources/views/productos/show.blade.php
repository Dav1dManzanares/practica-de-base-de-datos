@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Detalles del Producto</h2>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('productos.index') }}">Volver</a>
                        <br><br>
                       
                        <div class="form-group">
                            <strong>ID:</strong>
                            {{ $producto->_id }}
                        </div>
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $producto->nombre }}
                        </div>
                        
                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $producto->descripcion }}
                        </div>
                        
                        <div class="form-group">
                            <strong>Precio:</strong>
                            ${{ $producto->precio }}
                        </div>
                        
                        <div class="form-group">
                            <strong>Stock:</strong>
                            {{ $producto->stock }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection