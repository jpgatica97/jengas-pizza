@extends('layouts.plataforma')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header">
                <h2>{{$producto->nombre}}</h2>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="codigo" class="col-sm-2 col-form-label">Código:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" id="codigo" value="({{$producto->codigo}})">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="descripcion" class="col-sm-2 col-form-label">Descripción:</label>
                    <div class="col-sm-10">
                        <textarea type="text" readonly class="form-control" id="descripcion" value="{{$producto->descripcion}}">{{$producto->descripcion}} </textarea>
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="precio" class="col-sm-2 col-form-label">Precio:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" id="precio" value="${{$producto->precio}}">
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="stock" class="col-sm-2 col-form-label">Stock:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" id="stock" value="{{$producto->stock}} Unidades">
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-secondary" href="{{ route('plataforma.productos.index') }}"><i class="fas fa-th-list"></i> Volver a la lista</a>
        <a class="btn btn-primary" href="{{ route('plataforma.productos.edit', [
                                'producto' => $producto->codigo]) }}"><i class="fas fa-edit"></i> Editar este producto</a>
        <form class="d-inline" action="{{route('plataforma.productos.destroy', [
                                'producto' => $producto->codigo])}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar este producto</button>
        </form>
    </div>
@endsection
