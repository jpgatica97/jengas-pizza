@extends('layouts.app')

@section('content')
<div class="container" style="display: flex">
    <img src="{{asset('publicidad/image00125.png')}}" height="200px">
    <div style="margin-left: 10px">
        <h2 style="color: white">Bienvenidos a Jenga's Pizza</h2>
        <p style="color: white">Pizzas a la piedra</p>
        <p style="color: white">Sabor y estilo americano</p>
        <p style="color: white">Concepto único en la zona!! "Hot and Ready"</p>
        <h3 style="color: white"><u>Horarios de atención:</u></h3>
        <p style="color: white">Lunes a Sábado <strong>de 16:00hrs a 00:00hrs</strong></p>
    </div>
</div>
<div style="display: flex; position: sticky">
    <div style="position: absolute; right: 5px">
        <a style="text-align: right; color: white" href="https://wa.me/message/H4Y4TCF5CJOXD1" target="_blank"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/150px-WhatsApp.svg.png" height="100px" alt="WhatsApp"></a>
    </div>

</div>

<div class="container">
    <div class="row">
            @foreach($promociones as $promo)
            <div class="col-sm-3">
                <div class="card" style="width: 18rem; margin-top: 10px; background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0), rgba(255,255,255,0.5))">
                    <img src="{{ asset('publicidad/image00087.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white"> {{ $promo->nombre }}</h5>
                        <h5 class="card-title" style="color: white"> <span class="badge text-bg-info">{{ $promo->categoria }}</span></h5>
                        <p class="card-text" style="color: white">{{ $promo->descripcion }}</p>
                        <p style="color: white">Precio: <strong>{{ $promo->precio }}</strong></p>
                        <form action="{{ route('promociones.carritos.store', ['promocion' => $promo->codigo]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Lo quiero!</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
    <div>
@endsection
