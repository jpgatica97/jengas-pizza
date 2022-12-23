<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boleta</title>
</head>

<body style="page-break-inside: avoid;">
    <div style="background-color: white">
        <table style="width: 100%; overflow: visible ; vertical-align: middle;">
            <td style="width: 10%; float:left; font-family: Arial, Helvetica, sans-serif; font-size: 10px; vertical-align: middle; color:red;">
                <img src="{{ asset('publicidad/image00124.png') }}" style="height: 80px; width: 90px"alt="Jenga's pizza">Jenga's Pizza
            </td>
            <td
                style="margin:0px auto; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;margin-right: auto; margin-left: auto; text-align: center;">
                <h3>Boleta</h3>
            </td>
            <td
                style="border: 3px solid red; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; text-align: center; width:200px; height:40px;">
                <h5>Boleta N°{{ $ventas->id }} </h5>
            </td>

        </table>
        <div>
            <table
                style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; vertical-align: middle;">
                <td style="width: 50%; border: 1px solid white; text-align: left; margin-top: 0px auto;">
                    <strong></strong>
                </td>
                <td style="width: 50%;border: 1px solid white; text-align: right; margin-top: 0px auto;">
                    <strong>Fecha:</strong> @php
                        echo \Carbon\Carbon::parse($ventas->fecha)->format('d/m/Y');
                    @endphp
                </td>
            </table>
        </div>

        <div>
            <table
                style="page-break-inside: avoid; font-family: Arial, Helvetica, sans-serif; vertical-align: top; width: 100%; font-size: 12px; border-collapse: collapse; ">
                <thead>
                   <tr>
                    <th style="width: 50%; background-color:white; float:left; font-size: 13px;">Datos venta:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @if ($ventas->medio_venta == "online")
                        <td><strong>Nombre Cliente: </strong>
                            {{ $ventas->cliente->nombre_completo }}</td>
                        @elseif ($ventas->medio_venta == "presencial")
                        <td><strong>Nombre Vendedor: </strong>
                            {{ $ventas->cliente->nombre_completo }}</td>
                        @endif
                    </tr>
                    <tr>
                        @if ($ventas->medio_venta == "online")
                        <td><strong>Dirección cliente: </strong>
                            {{ $ventas->cliente->direccion }}</td>
                        @elseif ($ventas->medio_venta == "presencial")
                        <td></td>
                        @endif
                    </tr>
                    <tr>
                        @if ($ventas->medio_venta == "online")
                        <td><strong>Email cliente: </strong>
                            {{ $ventas->cliente->email }}</td>
                        @elseif ($ventas->medio_venta == "presencial")
                        <td></td>
                        @endif
                    </tr>
                    <tr>
                        @if ($ventas->medio_venta == "online")
                        <td><strong>Teléfono cliente: </strong>
                            {{ $ventas->cliente->telefono }}</td>
                        @elseif ($ventas->medio_venta == "presencial")
                        <td></td>
                        @endif
                    </tr>
                    <tr>
                        @if ($ventas->medio_venta == "online")
                        <td><strong>Metodo pago </strong>
                            {{ $ventas->metodo_pago }}</td>
                        @elseif ($ventas->medio_venta == "presencial")
                        <td><strong>Metodo pago </strong>
                            {{ $ventas->metodo_pago }}</td>
                        @endif
                    </tr>
                </tbody>
            </table>

            <br>
            <div style="height: 400px;">
                <table style="border-collapse: collapse; width: 100%; page-break-inside: avoid;">
                    <thead style="font-family: Arial, Helvetica, sans-serif;">
                        <tr style="border: 1px solid black;">
                            <th style="border: 1px solid black;">Código</th>
                            <th style="border: 1px solid black;">Nombre</th>
                            <th style="border: 1px solid black;">Cantidad</th>
                            <th style="border: 1px solid black;">Precio</th>
                            <th style="border: 1px solid black;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody style="border: 1px solid black; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                        @foreach ($promos as $promo)
                            <tr style="border: 1px solid black;">
                                @foreach ($promociones as $promocion)
                                    @if ($promocion->codigo == $promo->codigo_promocion && $promo->codigo_promocion == $promocion->codigo)
                                        <td style="border: 1px solid black;"> {{ $promo->codigo_promocion }} </td>
                                    @endif
                                @endforeach
                                @foreach ($promociones as $promocion)
                                    @if ($promocion->codigo == $promo->codigo_promocion && $promo->codigo_promocion == $promocion->codigo)
                                        <td style="border: 1px solid black;"> {{ $promocion->nombre }} </td>
                                    @endif
                                @endforeach
                                @foreach ($promociones as $promocion)
                                    @if ($promocion->codigo == $promo->codigo_promocion && $promo->codigo_promocion == $promocion->codigo)
                                        <td style="border: 1px solid black;"> {{ $promo->cantidad }} </td>
                                    @endif
                                @endforeach

                                @foreach ($promociones as $promocion)
                                    @if ($promocion->codigo == $promo->codigo_promocion && $promo->codigo_promocion == $promocion->codigo)
                                        <td style="border: 1px solid black;"> ${{ $promocion->precio }} </td>
                                    @endif
                                @endforeach
                                @foreach ($promociones as $promocion)
                                    @if ($promocion->codigo == $promo->codigo_promocion && $promo->codigo_promocion == $promocion->codigo)
                                        <td style="border: 1px solid black;"> ${{ $promo->subtotal }} </td>
                                    @endif
                                @endforeach

                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>

        </div>
        <hr>
        <div>
            <table
                style=" width: 100%; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 14px;">
                <tr>
                    <td style="width: 70%;"></td>
                    <td style="width: 30%; border: 3px solid black;">
                        <strong> Neto: </strong>${{ $ventas->neto }} <br>
                        <strong>IVA: </strong>${{ $ventas->iva }} <br>
                        <strong>Total: </strong>${{ $ventas->total }}
                    </td>
                </tr>
            </table>
        </div>


</body>

</html>
