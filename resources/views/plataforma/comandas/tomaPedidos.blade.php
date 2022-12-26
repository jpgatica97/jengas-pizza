@extends('layouts.plataforma')

@section('content')
    <div class="container" style="background-color: rgba(215,215,215,0.1);
    background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Pedidos sin preparar</h1>

        @if ($ventas->isEmpty())
            <div class="alert alert-warning">
                No hay pedidos
            </div>
        @else
            <div class="table-responsive">
                <table class="table-responsive table-bordered border-primary" id="misEmpleados">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Fecha</th>
                            <th>Medio de venta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                                <td>{{ $venta->id }}</td>
                                <td>{{ $venta->fecha }}</td>
                                <td>{{ $venta->medio_venta }}</td>
                                <td>
                                    <a class="btn btn-info"
                                        href="{{ route('plataforma.ventas.show', [
                                            'venta' => $venta->id,
                                        ]) }}"><i
                                            class="fas fa-eye"></i> Ver</a>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalComanda{{ $venta->id }}"><i
                                            class="fas fa-kitchen"></i>Tomar pedido</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    @foreach ($ventas as $venta)
    <div class="modal fade" id="modalComanda{{ $venta->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Enviar a comanda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('comandas.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id_venta" value="{{ $venta->id }}">
                        <div class="col">
                            <p>Está segur@ de tomar el pedido n° {{$venta->id}} para la comanda?</p>
                            <input type="hidden" class="form-control" name="rut_encargado"
                                value="{{ Auth::user()->rut }}" required>
                            <input type="hidden" class="form-control" name="id_venta" value="{{ $venta->id }}"
                                required>
                            <input type="hidden" class="form-control" name="fecha"
                                value="{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d') }}"
                                required>
                            <input type="hidden" class="form-control" name="estado" value="pendiente" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                    <button type="submit" class="btn btn-warning"> Enviar a comanda</button>
                </div>
            </div>

            </form>

        </div>

    </div>
    @endforeach

@endsection
