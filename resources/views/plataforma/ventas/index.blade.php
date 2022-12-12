@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Ventas en el local</h1>

        @if ($ventas->isEmpty())
            <div class="alert alert-warning">
                No hay ventas registradas
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
                        <tr>
                            <td>{{$venta->id}}</td>
                            <td>{{$venta->fecha}}</td>
                            <td>{{$venta->metodo_pago}}</td>
                            <td>{{$venta->estado}}</td>
                            <td>{{$venta->total}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.ventas.show', [
                                    'venta' => $venta->id]) }}"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection

