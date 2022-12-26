@extends('layouts.plataforma')

@section('content')
<div class="container" style="margin-top: 10px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style ="background-color: rgba(215,215,215,0.1);
                    background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
                        <div class="card-header" style="color: white; background-color: black">{{ __('Contenido de la promoción') }}</div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Nombre de promoción</label>
                                <div class="col-md-6">
                                    {{ $promocion->first()->nombre }}

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-end">Descripcion</label>
                                <div class="col-md-6">
                                    {{ $promocion->first()->descripcion }}
                                </div>
                            </div>

                                <br>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered border-primary">
                                <thead>
                                <tr>

                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cantidad</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($pp as $p)
                                    <tr>
                                        @foreach ($productos as $producto)
                                            @if ($p->codigo_producto == $producto->codigo)
                                            @if ($producto->codigo <= 1)
                                            <td style="color:yellow;"> <strong>{{ $producto->nombre }}</strong>(Poco stock) </td>
                                            @else

                                            <td> {{ $producto->nombre }} </td>
                                            @endif
                                            @endif
                                        @endforeach

                                        <td> {{ $p->cantidad }} </td>

                                    </tr>
                                @endforeach

                            </table>
                        </div>
                        <div class="container" style="text-align: center">
                            <a type="button" class="btn btn-success" href="{{ route('plataforma.ingredientes.index')}}">
                                Listo</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
