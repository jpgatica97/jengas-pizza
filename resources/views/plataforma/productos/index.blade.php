@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Inventario</h1>

        <a class="btn btn-success mb-3" href="{{ route('plataforma.productos.create') }}"><i class="fas fa-plus-circle"></i> Agregar producto</a>

        @if ($productos->isEmpty())
            <div class="alert alert-warning">
                No hay productos registrados
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
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{$producto->codigo}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->descripcion}}</td>
                            <td>${{$producto->precio}}</td>
                            <td>{{$producto->stock}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.productos.show', [
                                    'producto' => $producto->codigo]) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('plataforma.productos.edit', [
                                    'producto' => $producto->codigo]) }}"><i class="fas fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger"data-bs-toggle="modal"
                                        data-bs-target="#modalEliminar{{ $producto->codigo }}"><i class="fas fa-trash-alt"></i></button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    @foreach ($productos as $producto)
        <div class="modal fade" id="modalEliminar{{ $producto->codigo }}" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        Está segur@ de eliminar el producto<strong> {{ $producto->nombre }} </strong>?
                        <hr>
                        <p class="text-center">Esta acción no se puede <strong>deshacer</strong>!!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                        <form class="d-inline"
                              action="{{ route('plataforma.productos.destroy', [
                            'producto' => $producto->codigo,
                        ]) }}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Eliminar producto</button>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    @endforeach
@endsection
