<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Diario</title>
</head>
<body>
    <table style="width: 100%; overflow: visible ; vertical-align: middle;">
        <td
            style="width: 10%; float:left; font-family: Arial, Helvetica, sans-serif; font-size: 20px; vertical-align: middle; color:darkturquoise;">
            <img src="{{ asset('publicidad/image00125.png') }}" style="height: 80px; width: 90px" alt="EZ">
        </td>
        <td
            style="margin:0px auto; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;margin-right: auto; margin-left: auto; text-align: center;">
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
        <td
            style="border: 3px solid red; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; text-align: center; width:200px; height:40px;">
            <h5>Cotización N°{{ $cotizacion->id }} </h5>
        </td>

    </table>

</body>
</html>
