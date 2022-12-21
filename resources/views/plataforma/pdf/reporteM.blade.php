<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="v<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reporte Mensual</title>
    </head>
    <body>
        <table style="width: 100%; overflow: visible ; vertical-align: middle;">
            <td style="width: 30%; float:left; font-family: Arial, Helvetica, sans-serif; font-size: 10px; vertical-align: middle; color:red;">
                <img src="{{ asset('publicidad/image00124.png') }}" style="height: 80px; width: 90px" alt="Jengas">Jenga's Pizza
            </td>
            <td style="margin:0px auto; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;margin-right: auto; margin-left: auto; text-align: center;">
                <h3>Reporte mensual periodo @php
                    if ($mes == '01') {
                        echo 'Enero';
                    }
                    if ($mes == '02') {
                        echo 'Febrero';
                    }
                    if ($mes == '03') {
                        echo 'Marzo';
                    }
                    if ($mes == '04') {
                        echo 'Abril';
                    }
                    if ($mes == '05') {
                        echo 'Mayo';
                    }
                    if ($mes == '06') {
                        echo 'Junio';
                    }
                    if ($mes == '07') {
                        echo 'Julio';
                    }
                    if ($mes == '08') {
                        echo 'Agosto';
                    }
                    if ($mes == '09') {
                        echo 'Septiembre';
                    }
                    if ($mes == '10') {
                        echo 'Octubre';
                    }
                    if ($mes == '11') {
                        echo 'Noviembre';
                    }
                    if ($mes == '12') {
                        echo 'Diciembre';
                    }
                    echo ' del ' . $anio;
                @endphp</h3>
            </td>
            <td style="text-align: right">
                <h5>Fecha de informe: {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('d-m-Y') }}</h5>
            </td>
        </table>

        <div style="font-family: Arial, Helvetica, sans-serif; border: 1px solid black">
            <h3 style="text-align: center;"><u>Ventas del periodo</u></h3>
            <h4 style="margin-left: 5px">Total ventas realizadas online: <strong>{{ $cantOnline['0']->veces }}</strong></h4>
            <h4 style="margin-left: 5px">Total ventas realizadas presencial: <strong>{{ $cantPresencial['0']->veces }}</strong></h4>
            <hr>
            <h4 style="margin-left: 5px">Total ventas realizadas en el mes: <strong>{{ ($cantPresencial['0']->veces + $cantOnline['0']->veces)}}</strong></h4>
        </div>
        <br>
        @php
            $maximo = $promosCantidad['0']->veces;
            $minimo = $promosCantidad['0']->veces;
        @endphp

        @foreach ($promosCantidad as $pc)
            @if ($maximo < $pc->veces)
                @php
                    $maximo = $pc->veces
                @endphp
            @endif
            @if ($minimo > $pc->veces)
            @php
                $minimo = $pc->veces
            @endphp

            @endif
        @endforeach

        <div style="font-family: Arial, Helvetica, sans-serif; border: 1px solid black">
            <h3 style="text-align: center;"><u>Promociones vendidas</u></h3>
            @foreach ($promosCantidad as $pc)
            @if ($maximo == $pc->veces && $minimo != $pc->veces)
                <h4 style="margin-left: 5px">Promoción más vendida: <u>{{ $pc->nombre }}</u> con {{ $pc->veces }} unidades</h4>
            @endif
            @if ($minimo == $pc->veces && $maximo != $pc->veces)
                <h4 style="margin-left: 5px">Promoción menos vendida: <u>{{ $pc->nombre }}</u> con {{ $pc->veces }} unidades</h4>
            @endif
            @if ($minimo == $pc->veces && $maximo == $pc->veces)
                <h4 style="margin-left: 5px">Promoción vendida: <u>{{ $pc->nombre }}</u> con {{ $pc->veces }} unidades</h4>
            @endif
            @endforeach
        </div>
        <h3><u>Cantidad ventas por dia</u> </h3>
        <div>
            <table style="border-collapse: collapse; font-family: Arial, Helvetica, sans-serif;">
                <thead style="border: 1px solid black;">
                    <tr style="border: 1px solid black;">
                        <th style="border: 1px solid black; padding: 5px;">Fecha</th>
                        <th style="border: 1px solid black; padding: 5px;">Cantidad ventas</th>
                    </tr>
                </thead>

                <tbody style="border: 1px solid black;">
                    @foreach ($cantVentas as $cv)

                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black; padding: 5px;">{{ $cv->dia }} </td>
                                <td style="border: 1px solid black; padding: 5px;">{{ $cv->veces }}</td>

                            </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <h3><u>Detalle por venta en el mes</u> </h3>
        <div>
            <table style="border-collapse: collapse; font-family: Arial, Helvetica, sans-serif;">
                <thead style="border: 1px solid black;">
                    <tr style="border: 1px solid black;">
                        <th style="border: 1px solid black; padding: 5px;">N° de venta</th>
                        <th style="border: 1px solid black; padding: 5px;">Fecha y hora</th>
                        <th style="border: 1px solid black; padding: 5px;">Cliente/Vendedor</th>
                        <th style="border: 1px solid black; padding: 5px;">Método pago</th>
                        <th style="border: 1px solid black; padding: 5px;">Medio de venta</th>
                        <th style="border: 1px solid black; padding: 5px;">Total pagado</th>
                    </tr>
                </thead>
                @php
                    $totalRecaudado = 0;
                @endphp
                <tbody style="border: 1px solid black;">
                    @foreach ($ventas as $venta)
                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black; padding: 5px;">{{ $venta->id }} </td>
                                <td style="border: 1px solid black; padding: 5px;">@php

                                    echo \Carbon\Carbon::parse($venta->fecha)->format('d-m-Y H:i');
                                    $totalRecaudado = $totalRecaudado + $venta->total;
                                @endphp </td>
                                <td style="border: 1px solid black; padding: 5px;">{{ $venta->cliente->nombre_completo }}</td>
                                <td style="border: 1px solid black; padding: 5px;">{{ $venta->metodo_pago }} </td>
                                <td style="border: 1px solid black; padding: 5px;">{{ $venta->medio_venta }} </td>
                                <td style="border: 1px solid black; padding: 5px;">${{ $venta->total }} </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="font-family: Arial, Helvetica, sans-serif; border: 1px solid black">
            <h3 style="margin-left: 5px">Total recaudado: ${{$totalRecaudado}}</h3>
        </div>
    </body>
</html>
