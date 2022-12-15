@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Comandas</h1>

        @if ($comandas->isEmpty())
            <div class="alert alert-warning">
                No hay comandas
            </div>
        @else

            <div class="table-responsive" >
                <table class="table-responsive table-bordered border-primary" id="misProductos" >
                    <thead class="thead-dark">
                    <tr>
                        <th>N° Venta</th>
                        <th>Cocinero/a encargado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($comandas as $comanda)
                        <tr>
                            <td>{{$comanda->id_venta}}</td>
                            <td>
                                @foreach ($cocineros as $cocinero)
                                    @if ($cocinero->rut == $comanda->rut_encargado)
                                    {{$cocinero->nombre_completo}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$comanda->estado}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.comandas.show', [
                                    'comanda' => $comanda->id]) }}"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
@section('js')

        @if(session('finalizado') == 'ok')
           <script>
               Swal.fire(
                   'Finalizado!',
                   'La comanda ha sido finalizada exitosamente',
                   'success'
               )
           </script>

        @endif

@endsection
