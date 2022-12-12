@extends('layouts.plataforma')

@section('content')
    <form action="{{ route('plataforma.usuarios.update', ['usuario' => $usuario->rut]) }}" method="post">
        @csrf
        @method('put')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
                        <div class="card-header" style="color: white; background-color: black">{{ __('Editar usuario') }}</div>
                        <div class="card-body">
                            <div class="row mb-3">

                                <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nombre"
                                           value="{{ old('nombre_completo') ?? $usuario->nombre_completo }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end" for="rol">Rol</label>

                                <div class="col-md-6">
                                    <select class="form-select" id="rol" name="rol">
                                        <option value="vendedor">Vendedor/a</option>
                                        <option value="cocinero">Cocinero/a</option>
                                        <option value="repartidor">Repartidor/a</option>
                                        <option value="administrador">Administrador/a</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label for="descripcion" class="col-md-4 col-form-label text-md-end">Email</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="email"
                                           value="{{ old('email') ?? $usuario->email }}">
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label for="precio" class="col-md-4 col-form-label text-md-end">Dirección</label>
                                <div class="col-md-6">
                                    <input type="text"  class="form-control" name="direccion"
                                           value="{{ old('direccion') ?? $usuario->direccion }}">
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label for="stock" class="col-md-4 col-form-label text-md-end">Habilitado?</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="habilitacion" disabled
                                           value="{{ old('habilitacion') ?? $usuario->habilitacion }}">
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg">Actualizar Usuario</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
