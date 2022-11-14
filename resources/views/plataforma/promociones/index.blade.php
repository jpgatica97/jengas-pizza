@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Lista de promociones</h1>

        <a class="btn btn-success mb-3" href="{{ route('plataforma.promociones.create') }}"><i class="fas fa-plus-circle"></i> Agregar promo</a>

        @if ($promociones->isEmpty())
            <div class="alert alert-warning">
                No hay promociones registradas
            </div>
        @else

            <div class="table-responsive" >
                <table class="table-responsive table-bordered border-primary" id="misProductos" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($promociones as $promocion)
                        <tr>
                            <td>{{$promocion->codigo}}</td>
                            <td>{{$promocion->nombre}}</td>
                            <td>{{$promocion->descripcion}}</td>
                            <td>${{$promocion->precio}}</td>
                            <td>{{$promocion->categoria}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.promociones.show', [
                                    'promocion' => $promocion->codigo]) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('plataforma.promociones.edit', [
                                    'promocion' => $promocion->codigo]) }}"><i class="fas fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger"data-bs-toggle="modal"
                                        data-bs-target="#modalEliminar{{ $promocion->codigo }}"><i class="fas fa-trash-alt"></i></button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    @foreach ($promociones as $promocion)
        <div class="modal fade" id="modalEliminar{{ $promocion->codigo }}" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar promoción</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        Está segur@ de eliminar la promoción<strong> {{ $promocion->nombre }} </strong>?
                        <hr>
                        <p class="text-center">Esta acción no se puede <strong>deshacer</strong>!!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                        <form class="d-inline"
                              action="{{ route('plataforma.promociones.destroy', [
                            'promocion' => $promocion->codigo,
                        ]) }}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Eliminar promoción</button>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    @endforeach
@endsection
