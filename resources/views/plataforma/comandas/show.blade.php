@extends('layouts.plataforma')

@section('content')
    <div class="container">
        <div class="card shadow-sm" style="background-color: rgba(215,215,215,0.1);
        background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
            <div class="card-header" style="color: white; background-color: black">
                <h2 style="text-align: center">Comanda</h2>
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
                <div class="container">
                    <h3><strong>Observaciones:</strong> {{$comanda->venta->observaciones}}</h3>
                </div>
            </div>

        <form class="d-inline form-finalizar-com" style="text-align: center" action="{{route('plataforma.comandas.finalizar', [
            'comanda' => $comanda->id])}}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" class="form-control" name="estado"value="finalizado" required>
            <input type="hidden" class="form-control" name="id"
                                            value="{{$comanda->id}}" required>
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Finalizar comanda</button>
        </form>
        <form class="d-inline form-rechazar-com" style="text-align: center" action="{{route('plataforma.comandas.rechazar', [
            'comanda' => $comanda->id])}}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" class="form-control" name="estado"value="rechazado comanda" required>
            <input type="hidden" class="form-control" name="id" value="{{$comanda->id}}" required>
            <input type="hidden" class="form-control" name="id_venta" value="{{$comanda->id_venta}}" required>
            <button type="submit" class="btn btn-warning"><i class="fas fa-deny"></i> Rechazar comanda</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $('.form-finalizar-com').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro/a de finalizar la comanda?',
                text: "La comanda se marcará como finalizado y estará listo para su despacho",
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
    <script>
        $('.form-rechazar-com').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro/a de rechazar la comanda?',
                text: "La comanda se marcará como rechazada y se avisará a vendedor para que la pueda anular",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, rechazar!',
                cancelButtonText: 'No, cancelar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        });
    </script>
@endsection
