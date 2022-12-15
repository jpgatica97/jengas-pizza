@extends('layouts.plataforma')

@section('content')
    <div class="container" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
        <h1 style="margin-top: 10px">Empleados</h1>

        <a class="btn btn-success mb-3" href="{{ route('register') }}"><i class="fas fa-plus-circle"></i> Agregar empleado</a>

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
                        <th>email</th>
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
                            <td>{{$usuario->email}}</td>
                            <td>
                                @if($usuario->habilitacion=="habilitado")
                                    <span class="badge bg-success">{{$usuario->habilitacion}}</span>
                                @elseif($usuario->habilitacion=="deshabilitado")
                                    <span class="badge bg-danger">{{$usuario->habilitacion}}</span>
                                @endif
                            </td>

                            <td>
                                <a class="btn btn-info" href="{{ route('plataforma.usuarios.show', [
                                    'usuario' => $usuario->rut]) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('plataforma.usuarios.edit', [
                                    'usuario' => $usuario->rut]) }}"><i class="fas fa-edit"></i></a>
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

        @if(session('eliminar') == 'ok')
           <script>
               Swal.fire(
                   'Borrado!',
                   'El usuario ha sido eliminado.',
                   'success'
               )
           </script>

        @endif
        <script>
        $('.form-eliminar-prod').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro/a de eliminar el usuario?',
                text: "Esta acción no es reversible!",
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
