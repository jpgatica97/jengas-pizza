@extends('layouts.plataforma')

@section('content')
<div class="container" style="margin-top: 10px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style ="background-color: rgba(215,215,215,0.1);
                    background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
                        <div class="card-header" style="color: white; background-color: black">{{ __('Asociar ingrediente a promoción') }}</div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Nombre de promoción</label>
                                <div class="col-md-6">
                                    {{ $promocion->first()->nombre }}

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-end">Descripcion</label>
                                <div class="col-md-6">
                                    {{ $promocion->first()->descripcion }}
                                </div>
                            </div>
                                <div class="col-md-6 offset-md-4">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insertarModal">
                                            Asociar producto</button>
                                </div>
                                <br>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered border-primary">
                                <thead>
                                <tr>

                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($pp as $p)
                                    <tr>
                                        @foreach ($productos as $producto)
                                            @if ($p->codigo_producto == $producto->codigo)
                                                <td> {{ $producto->nombre }} </td>
                                            @endif
                                        @endforeach

                                        <td> {{ $p->cantidad }} </td>
                                        <td>
                                            <form class="d-inline"
                                                  action="{{ route('plataforma.ingredientes.destroy', [
                                                        'producto' => $p->codigo_producto,
                                                        'promocion' => $p->codigo_promocion,
                                                    ]) }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                        <div class="container" style="text-align: center">
                            <a type="button" class="btn btn-success" href="{{ route('plataforma.ingredientes.index')}}">
                                Listo</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
    <div class="modal fade" id="insertarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asociar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('ingredientes.store', ['promocion' => $promocion->first()->codigo ]) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <label for="codigo_producto">Productos:</label>
                                    <div class="col-md-12">
                                        <select class="form-select" id="codigo_producto" name="codigo_producto">
                                            <option selected value="">Seleccione producto...</option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->codigo }}">{{ $producto->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="codigo">Cantidad:</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="cantidad" value="1"
                                               required>
                                        <input type="hidden" class="form-control" name="codigo_promocion" value="{{$promocion->first()->codigo}}">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar a la promoción</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
