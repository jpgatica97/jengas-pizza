@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Recetario</h1>

        <a class="btn btn-success mb-3" href="{{ route('plataforma.productos.create') }}"><i class="fas fa-plus-circle"></i> Agregar producto</a>

        @if ($promociones->isEmpty())
            <div class="alert alert-warning">
                No hay promociones registradas
            </div>
        @else

            <div class="table-responsive" >
                <table class="table-responsive table-bordered border-primary" id="misProductos" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Código Promoción</th>
                        <th>Nombre Promo</th>
                        <th>Descripción</th>
                        <th>Ingredientes Asociados</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($promociones as $promocion)
                        <tr>
                            <td>{{$promocion->codigo}}</td>
                            <td>{{$promocion->nombre}}</td>
                            <td>{{$promocion->descripcion}}</td>
                            <td>${{$total}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.ingredientes.show', [
                                    'promocion' => $promocion->codigo]) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('plataforma.ingredientes.edit', [
                                    'promocion' => $promocion->codigo]) }}"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection

