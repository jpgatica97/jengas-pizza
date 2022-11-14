@extends('layouts.plataforma')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header">
                <h2>{{$promocion->nombre}}</h2>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="codigo" class="col-sm-2 col-form-label">Código:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" id="codigo" value="({{$promocion->codigo}})">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="descripcion" class="col-sm-2 col-form-label">Descripción:</label>
                    <div class="col-sm-10">
                        <textarea type="text" readonly class="form-control" id="descripcion" value="{{$promocion->descripcion}}">{{$promocion->descripcion}} </textarea>
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="precio" class="col-sm-2 col-form-label">Precio:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" id="precio" value="${{$promocion->precio}}">
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="categoria" class="col-sm-2 col-form-label">Categoría:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" id="categoria" value="{{$promocion->categoria}} Unidades">
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-secondary" href="{{ route('plataforma.promociones.index') }}"><i class="fas fa-th-list"></i> Volver a la lista</a>
        <a class="btn btn-primary" href="{{ route('plataforma.promociones.edit', [
                                'promocion' => $promocion->codigo]) }}"><i class="fas fa-edit"></i> Editar esta promoción</a>
        <form class="d-inline" action="{{route('plataforma.promociones.destroy', [
                                'promocion' => $promocion->codigo])}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar esta promoción</button>
        </form>
    </div>
@endsection
