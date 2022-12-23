@extends('layouts.plataforma')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="background-color: rgba(215,215,215,0.1);
    background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
                    <div class="card-header" style="color: white; background-color: black">{{ __('Detalles empleado') }}</div>
                    <div class="card-body">
                        <div class="row mb-3">

                            <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nombre"
                                    value="{{ old('nombre_completo') ?? $usuario->nombre_completo }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="rol">Rol</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="rol"
                                    value="{{ old('rol') ?? $usuario->rol }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <label for="telefono" class="col-md-4 col-form-label text-md-end">Teléfono</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="telefono"
                                    value="{{ old('telefono') ?? $usuario->telefono }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email"
                                    value="{{ old('email') ?? $usuario->email }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <label for="direccion" class="col-md-4 col-form-label text-md-end">Dirección</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="direccion"
                                    value="{{ old('direccion') ?? $usuario->direccion }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <label for="habilitacion" class="col-md-4 col-form-label text-md-end">Habilitado?</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="habilitacion" disabled
                                    value="{{ old('habilitacion') ?? $usuario->habilitacion }}">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    @endsection
