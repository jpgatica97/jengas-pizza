@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Venta confirmada!</h1>
    <img src="{{ asset('publicidad/image00007.jpg') }}" alt="" width="200px">
    <h3>Muchas gracias por su compra ♥ </h3>
    <h4>Su número de seguimiento es el <u><strong>{{$venta->id}}</strong></u></h4>
    <p>Para hacer seguimiento de su compra, haz clic <a href="{{route('ventas.seguimiento', [
        'venta' => $venta->id])}}">aquí</a></p>
    <p>Descargue su boleta aquí   <a class="btn btn-primary" href="{{ route('plataforma.ventas.boleta', [
        'venta' => $venta->id]) }}"><i class="far fa-print"></i> Boleta </a></p>
</div>
@endsection
