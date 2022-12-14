@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Ventas online</h1>

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
                                <a class="btn btn-primary" href="{{ route('plataforma.ventas.boleta', [
                                    'venta' => $venta->id]) }}"><i class="far fa-print"></i> </a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>


<!-- Modal -->
<div class="modal fade" id="modalComanda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Enviar a Comanda</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="tomar" action="{{route('plataforma.ventas.tomarPedido', ['venta' => $venta->id]) }}" method="post">
                @csrf
                @method('put')
                <input type="hidden" class="form-control" name="estado" value="en preparacion" required>
                <input type="hidden" class="form-control" name="id_venta" value="{{$venta->id}}" required>
                <input type="hidden" class="form-control" name="fecha" value="{{  \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d') }}">
                <div class="row">
                    <input type="hidden" name="id_venta" value="{{ $venta->id }}">
                    <div class="col">
                        <label for="codigo">Seleccione cocinero:</label>
                        <div class="col-md-12">
                            <select class="form-select" id="rut_encargado" name="rut_encargdado">
                                <option selected value="">Seleccione cocinero...</option>
                                @foreach ($cocineros as $cocinero)
                                    <option value="{{ $cocinero->rut }}">{{ $cocinero->nombre_completo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>

            <button type="submit" class="btn btn-success"><i class="far fa-hat-chef"></i> Enviar a comanda</button>
        </form>
        </div>
      </div>
    </div>
  </div>

@endsection

