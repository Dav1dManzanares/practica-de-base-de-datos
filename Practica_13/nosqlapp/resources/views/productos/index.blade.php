@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Lista de Productos</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('productos.create') }}" class="btn btn-success mb-3">Crear Nuevo Producto</a>
                       
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                       
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th width="280px">Acción</th>
                            </tr>
                            @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->_id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->descripcion }}</td>
                                <td>${{ $producto->precio }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>
                                    <form action="{{ route('productos.destroy',$producto->_id) }}" method="POST">
                                        <a class="btn btn-info btn-sm" href="{{ route('productos.show',$producto->_id) }}">Ver</a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('productos.edit',$producto->_id) }}">Editar</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection