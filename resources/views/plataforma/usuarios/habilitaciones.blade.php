@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Habilitación Empleados</h1>

        @if ($usuarios->isEmpty())
            <div class="alert alert-warning">
                No hay usuarios registrados
            </div>
        @else

            <div class="table-responsive" >
                <table class="table-responsive table-bordered border-primary" id="misEmpleados" >
                    <thead class="thead-dark">
                    <tr>
                        <th>RUT</th>
                        <th>Nombre Completo</th>
                        <th>Rol</th>
                        <th>Habilitado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($usuarios as $usuario)
                        @if ($usuario->rol != "cliente")
                        <tr>
                            <td>{{$usuario->rut}}</td>
                            <td>{{$usuario->nombre_completo}}</td>
                            <td>{{$usuario->rol}}</td>
                            <td>
                                @if($usuario->habilitacion=="habilitado")
                                    <span class="badge bg-success">{{$usuario->habilitacion}}</span>
                                @elseif($usuario->habilitacion=="deshabilitado")
                                    <span class="badge bg-danger">{{$usuario->habilitacion}}</span>
                                @endif
                            </td>
                            <td>
                                @if($usuario->habilitacion=="habilitado")
                                    <form class="deshabil" action="{{route('plataforma.usuarios.deshabilitar', ['usuario' => $usuario->rut]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" class="form-control" name="habilitacion" value="deshabilitado" required>
                                        <button type="submit" class="btn btn-danger"> <i class="fas fa-toggle-off"></i> Deshabilitar </button>
                                    </form>
                                @elseif($usuario->habilitacion=="deshabilitado")
                                    <form class="habil" action="{{route('plataforma.usuarios.habilitar', ['usuario' => $usuario->rut]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" class="form-control" name="habilitacion" value="habilitado" required>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-toggle-on"></i> Habilitar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
@section('js')

    @if(session('habilitacion') == 'ok')
        <script>
            Swal.fire(
                'Habilitado!',
                'El usuario ha sido habilitado en el sistema!',
                'success'
            )
        </script>
    @endif
    @if(session('deshabilitacion') == 'ok')
        <script>
            Swal.fire(
                'Deshabilitado!',
                'El usuario ha sido deshabilitado del sistema!',
                'success'
            )
        </script>
    @endif
    <script>
        $('.habil').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro/a de habilitar el usuario?',
                text: "El usuario podrá volver a acceder a la plataforma!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, habilitar!',
                cancelButtonText: 'No, mantener deshabilitado!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })

        });


    </script>
    <script>
        $('.deshabil').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro/a de deshabilitar el usuario?',
                text: "El usuario no podrá acceder a la plataforma!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deshabilitar!',
                cancelButtonText: 'No, mantener habilitado!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })

        });


    </script>

@endsection
