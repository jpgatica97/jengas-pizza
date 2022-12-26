@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Ventas rechazadas por comanda</h1>

        @if ($ventas->isEmpty())
            <div class="alert alert-warning">
                No hay ventas para anular
            </div>
        @else

            <div class="table-responsive" >
                <table class="table-responsive table-bordered border-primary" id="misEmpleados" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Metodo de pago</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ventas as $venta)
                        @if ($venta->estado != "creacion")
                        <tr>
                            <td>{{$venta->id}}</td>
                            <td>@php

                                echo \Carbon\Carbon::parse($venta->fecha)->format('d-m-Y H:i');
                            @endphp</td>
                            <td>{{$venta->metodo_pago}}</td>
                            <td>{{$venta->estado}}</td>
                            <td>${{$venta->total}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.ventas.show', [
                                    'venta' => $venta->id]) }}"><i class="fas fa-eye"></i></a>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalAnular{{ $venta->id }}"><i
                                    class="fas fa-deny"></i>Anular</button>

                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @foreach ($ventas as $venta)
    <div class="modal fade" id="modalAnular{{ $venta->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Anular venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('ventas.anular', ['venta' => $venta->id]) }}"
                    method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id_venta" value="{{ $venta->id }}">
                            <div class="col">
                                <p>Estás segur@ de anular esta venta??</p>
                                <div class="col-md-12">
                                <input type="hidden" class="form-control" name="estado" value="anulado" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Anular</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endforeach

@endsection

