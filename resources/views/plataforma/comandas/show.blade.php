@extends('layouts.plataforma')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header">
                <h2>Comanda</h2>
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

        <form class="d-inline form-finalizar-com" action="{{route('plataforma.comandas.finalizar', [
            'comanda' => $comanda->id])}}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" class="form-control" name="estado"value="finalizado" required>
            <input type="hidden" class="form-control" name="id"
                                            value="{{$comanda->id}}" required>
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Finalizar comanda</button>
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
@endsection
