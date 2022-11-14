@extends('layouts.plataforma')

@section('content')
    <form action=" {{ route('promociones.store') }}" method="post">
        @csrf
        <div class="container" style="margin-top: 10px">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
                        <div class="card-header" style="color: white; background-color: black">{{ __('Agregar promoción') }}</div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Nombre</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                                           required>
                                </div> </div>
                            <div class="row mb-3">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-end">Descripcion</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="descripcion"
                                           value="{{ old('descripcion') }}" required>
                                </div></div>
                            <div class="row mb-3">
                                <label for="precio" class="col-md-4 col-form-label text-md-end">Precio</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="precio" value="{{ old('precio') }}"
                                           required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="categoria" class="col-md-4 col-form-label text-md-end">Categoria</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="categoria" value="{{ old('categoria') }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg">Agregar Promoción</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
