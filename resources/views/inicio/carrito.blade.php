@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Carrito de compras</h1>

    @if (!isset($carrito) || $carrito->promociones->isEmpty())
        Tu carrito está vacío
    @else
 @php
     $total = 0;
 @endphp
            @foreach ($carrito->promociones as $promo)
            <div class="row">
                @if (isset($carrito))
                <form action="{{ route('promociones.carritos.destroy', ['carrito' => $carrito->id, 'promocion' => $promo->codigo]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div style="display: flex; width: 100%">
                        <img src="{{ asset('publicidad/image00087.jpg') }}" alt="pizza" style="margin-top: 5px;" height="80px">
                        <div style="margin-left: 5px;">
                            {{$promo->pivot->cantidad}} x {{ $promo->nombre }}
                            <p>{{ $promo->descripcion }}</p>
                            <p style="margin-top: -5px"><strong>${{ $promo->precio }}</strong></p>
                        </div>
                        <div style="position: absolute; right: 5em;">
                            <h3>${{$promo->pivot->cantidad * $promo->precio}}</h3>
                        </div>
                        <div style="text-align: right; position: absolute; right: 1.5em;">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    @php
                        $total = $total + ($promo->pivot->cantidad * $promo->precio);
                    @endphp
                    </form>
                @endif
            </div>
            @endforeach
<br>
            <div class="container" style="position: absolute; right: 2em;">
                <h1>Total: <strong>$ {{$total}}</strong></h1>
                <a class="btn btn-success" href="{{route('ventasO.create')}}"><i class="fas fa-pay"></i> Crear Orden</a>
            </div>
    @endif
</div>

@endsection
