@extends('layouts.plataforma')

@section('content')
    <h1 style="margin-left: 10px; color: white;">Panel principal</h1>
    <br>
    @if (Auth::user()->rol == 'administrador' || Auth::user()->rol == 'vendedor')
        @if ($deshabilitaciones == true)
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    <h3>Poco stock de ingrediente</h3>
                    <p>
                        Se ha detectado un producto de inventario con muy poco stock, por lo que se han deshabilitado la
                        venta de ciertas promociones asociadas a este producto.
                        Para revisar inventario, presione <a class="alert-link"
                            href="{{ route('plataforma.productos.index') }}">aquí</a>
                    </p>
                </div>
            </div>
        @endif
        @if ($invisibles == true)
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <h3>Promocion(es) deshabilitada(s)</h3>
                    <p>
                        Se ha detectado una o más promociones deshabilitadas, para revisarlas, presione <a class="alert-link"
                            href="{{ route('plataforma.promociones.deshabilitados') }}">aquí</a> .
                    </p>
                </div>
            </div>
        @endif
        <br>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            @if (isset($cantPresencial->first()->veces))
                                <h3>{{ $cantPresencial->first()->veces }}</h3>
                            @else
                                <h3>0</h3>
                            @endif

                            <p>Ventas presenciales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('plataforma.ventas.index') }}" class="small-box-footer">Más info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            @if (isset($cantOnline->first()->veces))
                                <h3>{{ $cantOnline->first()->veces }}</h3>
                            @else
                                <h3>0</h3>
                            @endif

                            <p>Ventas Online</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('plataforma.ventas.indexOnline') }}" class="small-box-footer">Más info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            @php
                                $totalMes = 0;
                                foreach ($montoVentasMes as $mv) {
                                    $totalMes = $totalMes + $mv->total;
                                }
                            @endphp
                            <h3>${{ $totalMes }}</h3>

                            <p>Total recaudado en el mes</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Ventas de este mes</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            @if (isset($cantOnline->first()->veces) && isset($cantPresencial->first()->veces))
                                <span
                                    class="text-bold text-lg">{{ $cantOnline->first()->veces + $cantPresencial->first()->veces }}</span>
                            @else
                                <span class="text-bold text-lg">Faltan ventas</span>
                            @endif
                            <span>Total ventas</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="ventas-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> Venta online
                        </span>

                        <span>
                            <i class="fas fa-square text-gray"></i> Venta presencial
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="background-color: white">
            <h4>Top productos más vendidos</h4>
            <div class="container">
                @foreach ($cantProdVentas as $cp)
                    <li>{{ $cp->nombre }} con {{ $cp->veces }} veces </li>
                @endforeach

            </div>
        </div>
    @elseif (Auth::user()->rol == 'cocinero')
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <p>Tomar comanda</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pizza"></i>
                </div>
                <a href="{{ route('plataforma.comandas.tomar') }}" class="small-box-footer">ir <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <p>Mis comandas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pizza"></i>
                </div>
                <a href="{{ route('plataforma.comandas.index') }}" class="small-box-footer">ir <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @elseif (Auth::user()->rol == 'repartidor')
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-dark">
            <div class="inner">
                <p>ver repartos</p>
            </div>
            <div class="icon">
                <i class="ion ion-pizza"></i>
            </div>
            <a href="{{ route('plataforma.repartos.index') }}" class="small-box-footer">ir <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif
@endsection
@section('js')
    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script>
        $(function() {
            'use strict'

            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true
            var $ventasChart = $('#ventas-chart')
            // eslint-disable-next-line no-unused-vars
            var ventasChart = new Chart($ventasChart, {
                data: {
                    labels: [
                        //'18th', '20th', '22nd', '24th', '26th', '28th', '30th'
                        @foreach ($cantVentasMes as $cv)

                            '{{ $cv->dia }}',
                        @endforeach
                    ],
                    datasets: [{
                            type: 'line',
                            data: [
                                //100, 120, 170, 167, 180, 177, 160
                                //Cantidad online

                                @foreach ($cantVentasMes as $c)
                                    @php
                                        $cantidad = 0;
                                    @endphp
                                    @foreach ($cantVentasMesOnline as $co)
                                        @if ($co->dia == $c->dia)
                                            @php
                                                $cantidad = $co->veces;

                                            @endphp
                                        @endif
                                    @endforeach

                                    {{ $cantidad }}
                                    {{ ',' }}
                                @endforeach
                            ],
                            backgroundColor: 'transparent',
                            borderColor: '#007bff',
                            pointBorderColor: '#007bff',
                            pointBackgroundColor: '#007bff',
                            fill: false
                            // pointHoverBackgroundColor: '#007bff',
                            // pointHoverBorderColor    : '#007bff'
                        },
                        {
                            type: 'line',
                            data: [
                                //60, 80, 70, 67, 80, 77, 100
                                @foreach ($cantVentasMes as $c)
                                    @php
                                        $cantidad = 0;
                                    @endphp
                                    @foreach ($cantVentasMesPresencial as $cp)
                                        @if ($cp->dia == $c->dia)
                                            @php
                                                $cantidad = $cp->veces;

                                            @endphp
                                        @endif
                                    @endforeach

                                    {{ $cantidad }}
                                    {{ ',' }}
                                @endforeach
                            ],
                            backgroundColor: 'tansparent',
                            borderColor: '#ced4da',
                            pointBorderColor: '#ced4da',
                            pointBackgroundColor: '#ced4da',
                            fill: false
                            // pointHoverBackgroundColor: '#ced4da',
                            // pointHoverBorderColor    : '#ced4da'
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                //suggestedMax: 200
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        })
    </script>
@endsection
