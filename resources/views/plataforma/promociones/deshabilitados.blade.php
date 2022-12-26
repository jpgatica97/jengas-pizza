@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Promociones deshabilitadas</h1>

        @if ($promociones->isEmpty())
            <div class="alert alert-warning">
                No hay promociones registradas
            </div>
        @else

            <div class="table-responsive" >
                <table class="table-responsive table-bordered border-primary" id="misProductos" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Código Promoción</th>
                        <th>Nombre Promo</th>
                        <th>Descripción</th>

                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                    @foreach ($promociones as $promocion)
                        <tr>
                            <td>{{$promocion->codigo}}</td>
                            <td>{{$promocion->nombre}}</td>
                            <td>{{$promocion->descripcion}}</td>

                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.ingredientes.show', [
                                    'promocion' => $promocion->codigo]) }}"><i class="fas fa-eye"></i></a>
                                @if($promocion->visible=="invisible")
                                <form class="habil" action="{{route('plataforma.promociones.habilitar', ['promocion' => $promocion->codigo]) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" class="form-control" name="visible" value="visible" required>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-toggle-on"></i> Habilitar</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                        @php
                            $i = $i+1;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection

