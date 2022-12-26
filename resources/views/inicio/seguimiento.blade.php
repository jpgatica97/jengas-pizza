@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 10px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="background-color: rgba(215,215,215,0.1);
                        background-image: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.5))">
                    <div class="card-header" style="color: white; background-color: black">
                        {{ __('Seguimiento de compra n° ' . $venta->id) }}</div>
                    <div class="card-body">
                        @if ($venta->estado == "pagado")
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-label="Animated striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                        </div>
                        <div class="container" style="margin-top: 10px; text-align: center">
                            <div>
                                <i class="fas fa-cash-register" style="height:100px"></i>
                            </div>
                            <p>El pago de su compra ha sido recepcionada exitosamente, se preparará en unos minutos</p>
                        </div>
                        @endif
                        @if ($venta->estado == "en comanda")
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-label="Animated striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                        </div>
                        <div class="container" style="margin-top: 10px; text-align: center">
                            <div>
                                <ion-icon size="large" style="height: 100px" name="pizza-outline"></ion-icon>
                            </div>
                            <p>Se está preparando su pedido, esto tomará unos minutos</p>
                        </div>
                        @endif
                        @if ($venta->estado == "preparado")
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-label="Animated striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                        </div>
                        <div class="container" style="margin-top: 10px; text-align: center">
                            <div>
                                <i class="far fa-clipboard-check" style="height: 100px"></i>
                            </div>
                            <p>Su pedido ya está preparado, por favor, espere a que se asigne un repartidor para que vaya a dejar el pedido a su domicilio</p>
                        </div>
                        @endif
                        @if ($venta->estado == "en reparto")
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-label="Animated striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
                        </div>
                        <div class="container" style="margin-top: 10px; text-align: center">
                            <div>
                                <i class="far fa-motorcycle" style="height: 100px"></i>
                            </div>
                            <p>Su pedido ya está en camino a su domicilio, por favor, esté atento 👀</p>
                            <h3>Detalles reparto</h3>
                            <p><strong>Repartidor/a:</strong>{{$reparto->repartidor->nombre_completo}}</p>
                            <p><strong>Hora estimada llegada:</strong>{{$reparto->hora_entrega}}</p>
                        </div>
                        @endif
                        @if ($venta->estado == "finalizado")
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-label="Animated striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                        <div class="container" style="margin-top: 10px; text-align: center">
                            <div>
                                <i class="far fa-check-circle" style="height: 100px"></i>
                            </div>
                            <p>Su pedido ya está listo, gracias por comprar en Jenga's pizza y disfrute su pedido!♥</p>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
