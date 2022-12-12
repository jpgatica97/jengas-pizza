@extends('layouts.plataforma')

@section('content')
    <div class="container" style="margin-top: 10px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style ="background-color: rgba(215,215,215,0.1);
background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
                    <div class="card-header" style="color: white; background-color: black">{{ __('Crear Venta en Local') }}</div>

                    <div class="card-body">
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="rut_cliente"
                                       value="{{ Auth::user()->rut }}" required disabled>
                                <input type="hidden" class="form-control" name="medio_venta"
                                       value="local" required disabled>
                                <input type="hidden" class="form-control" name="estado"
                                       value="pagado" required disabled>
                                <input type="hidden" class="form-control" name="fecha"
                                       value=" @php

                                    echo \Carbon\Carbon::now()->format('d-m-Y');
                                @endphp" required disabled>
                            </div>
                        </div>

                        <div class="container">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#insertarModal">
                                Agregar producto
                            </button>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered border-primary">
                                <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($promociones_venta as $pv)
                                    <tr>
                                        <td> {{ $pv->id_venta }} </td>
                                        @foreach ($promociones as $promo)
                                            @if ($pv->codigo_promocion == $promo->codigo)
                                                <td> {{ $promo->nombre }} </td>
                                            @endif
                                        @endforeach
                                        <td> {{ $pv->cantidad }} </td>
                                        @foreach ($promociones as $promo)
                                            @if ($pv->codigo_promocion == $promo->codigo)
                                                <td> {{ $promo->precio }} </td>
                                            @endif
                                        @endforeach
                                        <td> {{ $pv->subtotal }} </td>
                                        <td>
                                            <form class="d-inline"
                                                  action="{{ route('plataforma.ventas.eliminarP', [
                                                        'promo_venta' => $pv->id_venta,
                                                    ]) }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>


                        <form class="d-inline"
                              action="{{ route('plataforma.ventas.guardar', [
                                'venta' => $venta->id,
                            ]) }}"
                              method="post">
                            @csrf
                            @method('put')

                            <div class="container">
                                <div class="row">

                                    <div class="col"></div>
                                    <div class="col"></div>
                                    <div class="col" style="border: 1px solid black; text-align: right">
                                        <strong>Neto:</strong> $@if ($venta->neto == null)
                                            0
                                        @else
                                            {{ $venta->neto }}
                                        @endif
                                        <br>
                                        <strong>IVA:</strong> $@if ($venta->iva == null)
                                            0
                                        @else
                                            {{ $venta->iva }}
                                        @endif
                                        <br>

                                        <strong>Total:</strong> $@if ($venta->total == null)
                                            0
                                        @else
                                            {{ $venta->total }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalDeshacer">
                                    Deshacer venta</button>
                                @if ($venta->total != null)
                                    <button type="submit" class="btn btn-success" data-bs-toggle="modal">
                                        Crear venta</button>
                                @endif

                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="insertarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insertar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('ventas.insertar.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <input type="hidden" name="id_venta" value="{{ $venta->id }}">
                                <div class="col">
                                    <label for="codigo">Promociones:</label>
                                    <div class="col-md-12">
                                        <select class="form-select" id="codigo_promocion" name="codigo_promocion">
                                            <option selected value="">Seleccione promo...</option>
                                            @foreach ($promociones as $promo)
                                                <option value="{{ $promo->codigo }}">{{ $promo->nombre }} -
                                                    ${{ $promo->precio }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="codigo">Cantidad:</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="cantidad" value="1"
                                               required>
                                        <input type="hidden" class="form-control" name="subtotal" value="">
                                        <input type="hidden" class="form-control" name="neto" value="">
                                        <input type="hidden" class="form-control" name="iva" value="">
                                        <input type="hidden" class="form-control" name="total" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar a la venta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalDeshacer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Deshacer venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Está segur@ de cancelar la creación de esta venta?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form class="d-inline"
                          action="{{ route('plataforma.ventas.destroy', [
                            'venta' => $venta->id,
                        ]) }}"
                          method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Si</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#codigo_promocion').select2({
            dropdownParent: $('#insertarModal')
        });
    </script>
@endsection
