@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Despachos</h1>
        @if ($repartos->isEmpty())
            <div class="alert alert-warning">
                No hay despachos registrados
            </div>
        @else

            <div class="table-responsive" >
                <table class="table-responsive table-bordered border-primary" id="misrepartos" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Código venta</th>
                        <th>Nombre cliente</th>
                        <th>Dirección entrega</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($repartos as $reparto)
                        <tr>
                            <td>{{$reparto->id_venta}}</td>
                            <td>{{$reparto->venta->cliente->nombre_completo}}</td>
                            <td>{{$reparto->venta->cliente->direccion}}</td>
                            <td>{{$reparto->venta->cliente->email}}</td>
                            <td>{{$reparto->estado}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.repartos.show', [
                                    'reparto' => $reparto->id]) }}"><i class="fas fa-eye"></i>Ver</a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection

