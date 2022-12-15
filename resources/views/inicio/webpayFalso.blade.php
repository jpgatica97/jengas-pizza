@extends('layouts.app')
@section('content')
<div class="container" style="text-align: center">
    <img src="https://www.flow.cl/images/logos/wp-sf.svg" alt="200px">
</div>
<div class="container" style="text-align: center">
    <h2>Total a pagar: <strong>${{$venta->total}}</strong></h2>
</div>
@endsection
