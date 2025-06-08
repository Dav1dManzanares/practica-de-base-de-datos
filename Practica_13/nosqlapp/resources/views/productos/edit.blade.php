@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Editar Producto</h2>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('productos.index') }}">Volver</a>
                        <br><br>
                       
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>¡Error!</strong> Hay problemas con los datos ingresados.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                       
                        <form action="{{ route('productos.update', $producto->_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                       
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" placeholder="Nombre del producto">
                            </div>
                         
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" name="descripcion" placeholder="Descripción del producto">{{ $producto->descripcion }}</textarea>
                            </div>
                         
                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" class="form-control" placeholder="Precio">
                            </div>
                         
                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="number" name="stock" value="{{ $producto->stock }}" class="form-control" placeholder="Cantidad en stock">
                            </div>
                         
                            <button type="submit" class="btn btn-success mt-3">Actualizar</button>
                         
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection