@extends('layouts.plataforma')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header">
                <h2>Reparto de pedido de {{$reparto->venta->cliente->nombre_completo}}
                </h2>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($promos as $promo)
                    <li class="list-group-item">
                        <div class="container" style="display: flex">
                            <img src="{{ asset('publicidad/image00087.jpg') }}" alt="pizza" style="margin-top: 5px;" height="200px">
                            <div style="margin-left: 10px">
                                <h2>
                                    ({{$promo->cantidad}}) x
                                    @foreach ($promociones as $promocion)
                                        @if ($promo->codigo_promocion == $promocion->codigo)
                                         {{$promocion->nombre}}
                                        @endif
                                    @endforeach
                                </h2>

                                <p>
                                    @foreach ($promociones as $promocion)
                                        @if ($promo->codigo_promocion == $promocion->codigo)
                                         {{$promocion->descripcion}}</p>
                                        @endif
                                    @endforeach
                            </div>
                        </div>
                        @endforeach
                    </li>

                </ul>
            </div>
            <h4 style="text-align: center">Dirección de entrega: <strong>{{$reparto->venta->cliente->direccion}}</strong></h4>

        <div class="container" style="text-align: center">
            <form class="d-inline form-finalizar-com" action="{{route('plataforma.repartos.finalizar', [
            'reparto' => $reparto->id])}}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" class="form-control" name="estado"value="finalizado" required>
            <input type="hidden" class="form-control" name="id"
                                            value="{{$reparto->id}}" required>
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Finalizar despacho</button>
        </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.form-finalizar-com').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro/a de finalizar el despacho?',
                text: "El despacho se marcará como finalizado y la venta estará conclusa",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, finalizar!',
                cancelButtonText: 'No, cancelar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        });
    </script>
@endsection
