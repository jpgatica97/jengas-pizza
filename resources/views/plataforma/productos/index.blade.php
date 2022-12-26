@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Inventario</h1>

        <a class="btn btn-success mb-3" href="{{ route('plataforma.productos.create') }}"><i class="fas fa-plus-circle"></i> Agregar producto</a>

        @if ($productos->isEmpty())
            <div class="alert alert-warning">
                No hay productos registrados
            </div>
        @else

            <div class="table-responsive" >
                <table class="table-responsive table-bordered border-primary" id="misProductos" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Visibilidad</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{$producto->codigo}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->descripcion}}</td>
                            <td>${{$producto->precio}}</td>
                            <td>{{$producto->stock}}</td>
                            <td>{{$producto->visible}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.productos.show', [
                                    'producto' => $producto->codigo]) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('plataforma.productos.edit', [
                                    'producto' => $producto->codigo]) }}"><i class="fas fa-edit"></i></a>
                                    {{--}}
                                <form class="d-inline form-eliminar-prod"
                                      action="{{ route('plataforma.productos.destroy', [
                            'producto' => $producto->codigo,
                        ]) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                {{--}}
                                @if($producto->visible=="visible")
                                <form class="deshabil" action="{{route('plataforma.productos.deshabilitar', ['producto' => $producto->codigo]) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" class="form-control" name="visible" value="invisible" required>
                                    <button type="submit" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> </button>
                                </form>
                            @elseif($producto->visible=="invisible")
                                <form class="habil" action="{{route('plataforma.productos.habilitar', ['producto' => $producto->codigo]) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" class="form-control" name="visible" value="visible" required>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-toggle-on"></i> Habilitar</button>
                                </form>
                            @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
@section('js')

        @if(session('eliminar') == 'ok')
           <script>
               Swal.fire(
                   'Borrado!',
                   'El producto ha sido eliminado.',
                   'success'
               )
           </script>

        @endif
        <script>
        $('.form-eliminar-prod').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro/a de borrar el producto?',
                text: "Esta acción es reversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar!',
                cancelButtonText: 'No, cancelar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })

        });


    </script>
@endsection
