@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Pedidos sin despachar</h1>

        @if ($ventas->isEmpty())
            <div class="alert alert-warning">
                No hay ventas para despachar
            </div>
        @else
            <div class="table-responsive" >
                <table class="table-responsive table-bordered border-primary" id="sinreparto" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Código venta</th>
                        <th>Nombre cliente</th>
                        <th>Dirección entrega</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td>{{$venta->id}}</td>
                            <td>{{$venta->cliente->nombre_completo}}</td>
                            <td>{{$venta->cliente->direccion}}</td>

                            <td>{{$venta->cliente->email}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.ventas.show', [
                                    'venta' => $venta->id]) }}"><i class="fas fa-eye"></i>Ver</a>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearD{{$venta->id}}">
                                    Despachar</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Modal -->
    @foreach ($ventas as $venta)
    <div class="modal fade" id="modalCrearD{{$venta->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Tomar despacho</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <form class="d-inline"
                     action="{{ route('repartos.store') }}"
                     method="post">
                   @csrf
                   <h3>La dirección de este despacho es:</h3>
                   <h4>{{$venta->cliente->direccion}}</h4>
                   <input type="hidden" name="estado" value="en reparto">
                   <input type="hidden" name="id_venta" value="{{ $venta->id}}">
                   <input type="hidden" name="rut_repartidor" value="{{ Auth::user()->rut }}">
                   <label for="hora_entrega">Seleccione dia y HORA estimados de entrega:</label>
                   <input type="datetime-local" name="hora_entrega" id="hora_entrega" value="" min="{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d') }}" max="{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d') }}">

           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>


                   <button type="submit" class="btn btn-success">Crear</button>
               </form>
           </div>
       </div>
   </div>
</div>
    @endforeach

@endsection



