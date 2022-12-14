@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Orden de Compra</h1>

    @if ((!isset($carrito)) || $carrito->promociones->isEmpty())
        Tu carrito está vacío!! No se puede generar Orden de compra
    @else
@if ((!isset(Auth::user()->rut)))
<button class="btn btn-primary">Comprar sin registro</button>
@else
    @if (isset(Auth::user()->rut))
    <div class="row">
        <div class="mb-3 col">
            <strong>Nombre cliente:</strong> {{ Auth::user()->nombre_completo }}
        </div>

        <div class="mb-3 col">
            <strong>Dirección de entrega:</strong> {{Auth::user()->direccion }}
        </div>

    </div>
    <div class="row">
        <div class="mb-3 col">
            <strong>Email:</strong> {{ Auth::user()->email }}
        </div>
    </div>


    @else
    <div class="row">
        <div class="mb-3 col">
            <strong>Nombre cliente:</strong> {{ $usuario->nombre_completo }}
        </div>

        <div class="mb-3 col">
            <strong>Dirección de entrega:</strong> {{$usuario->direccion }}
        </div>

    </div>
    <div class="row">
        <div class="mb-3 col">
            <strong>Email:</strong> {{ $usuario->email }}
        </div>
    </div>

    @endif
@endif
 @php
     $total = 0;
 @endphp

<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
            <th>Promo</th>
            <th>Precio unitario</th>
            <th>Cantidad</th>
            <th>Total</th>
        </thead>
        <tbody>
            @foreach ($carrito->promociones as $promo)
            <tr>
                <td>{{$promo->nombre}}</td>
                <td>${{$promo->precio}}</td>
                <td>{{$promo->pivot->cantidad}}</td>
                <td>${{$promo->pivot->cantidad * $promo->precio}}</td>
            </tr>
            @php
                        $total = $total + ($promo->pivot->cantidad * $promo->precio);
                    @endphp
            @endforeach
        </tbody>
    </table>
</div>
<br>
            <div class="container">
                <h1>Total: <strong>$ {{$total}}</strong></h1>
            </div>
            <div class="container">
                <form action="{{route('ventasO.store') }}" method="post">
                @csrf
                @if ((isset(Auth::user()->rut)))
                <input type="hidden" class="form-control" name="fecha"value="{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d') }}" required>
                <input type="hidden" class="form-control" name="estado"value="creacion" required>
                <input type="hidden" class="form-control" name="neto"value="{{$total - ($total*0.19)}}" required>
                <input type="hidden" class="form-control" name="iva"value="{{($total*0.19)}}" required>
                <input type="hidden" class="form-control" name="total"value="{{$total}}" required>
                <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control" name="observaciones" id="observaciones" value="-" required>
                <input type="hidden" class="form-control" name="medio_venta"value="online" required>
                <input type="hidden" class="form-control" name="metodo_pago"value="webpay" required>
                <input type="hidden" class="form-control" name="rut_cliente"value="{{Auth::user()->rut}}" required>
                <br>
                    <button type="submit" class="btn btn-success"><i class="fas fa-pay"></i> Pagar</button>
                @endif
                </form>
            </div>
    @endif
</div>

@endsection
