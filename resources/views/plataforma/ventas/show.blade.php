@extends('layouts.plataforma')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col"><a class="btn btn-secondary" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i>
                    Volver</a></div>
            <div class="col"></div>
            <div class="col"></div>

        </div>
        <br>

        <div class="card shadow-sm"
            style="background-color: rgba(215,215,215,0.1);
    background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
            <div class="card-header">
                <h2>Venta n°{{ $venta->id }}</h2>
            </div>
            <div class="card-body"
                style="background-color: rgba(215,215,215,0.1);
        background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">

                <div class="row">
                    <div class="mb-3 col">
                        <strong>Nombre vendedor:</strong> {{ $venta->cliente->nombre_completo }}
                    </div>

                    <div class="mb-3 col">
                        <strong>Dirección de entrega:</strong> {{ $venta->cliente->direccion }}
                    </div>

                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <strong>Email:</strong> {{ $venta->cliente->email }}
                    </div>
                </div>

                <div class="mb-3 col">
                    <strong>Estado:</strong> {{ $venta->estado }}
                </div>
            </div>


            <br>

            <table class="table table-sm table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($promo_ventas as $pv)
                        <tr>
                            @foreach ($promociones as $promo)
                                @if ($venta->id == $pv->id_venta && $pv->codigo_promocion == $promo->codigo)
                                    <td> {{ $pv->codigo_promocion }} </td>
                                @endif
                            @endforeach

                            @foreach ($promociones as $promo)
                                @if ($venta->id == $pv->id_venta && $pv->codigo_promocion == $promo->codigo)
                                    <td> {{ $promo->nombre }} </td>
                                @endif
                            @endforeach
                            @foreach ($promociones as $promo)
                                @if ($venta->id == $pv->id_venta && $pv->codigo_promocion == $promo->codigo)
                                    <td> {{ $pv->cantidad }} </td>
                                @endif
                            @endforeach

                            @foreach ($promociones as $promo)
                                @if ($venta->id == $pv->id_venta && $pv->codigo_promocion == $promo->codigo)
                                    <td> ${{ $promo->precio }} </td>
                                @endif
                            @endforeach
                            @foreach ($promociones as $promo)
                                @if ($venta->id == $pv->id_venta && $pv->codigo_promocion == $promo->codigo)
                                    <td> ${{ $pv->subtotal }} </td>
                                @endif
                            @endforeach


                        </tr>
                    @endforeach
            </table>
            <div class="container">
                <div class="row" style="border: 1px black ">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col">
                        <div><strong>Neto: </strong> ${{ $venta->neto }}</div>
                        <div><strong>IVA: </strong> ${{ $venta->iva }}</div>
                        <div>
                            <h2><strong>TOTAL: </strong> ${{ $venta->total }}</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
