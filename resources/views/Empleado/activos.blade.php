<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
    <style>
        .logo {
            float: left;
            margin-right: 10px;
            width: 230px;
        }

        .fecha {
            float: right;
            margin-top: 0;
        }

        .cuerpo {
            margin: 2cm;
        }

        table {
            border: 5px double gray;
            border-collapse: collapse;
            font-size: 12px;
        }

        td,
        th {
            border: 2px solid gray;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body class="cuerpo">
    <main>
        <br>
        <div>
            <img src="{{ public_path('/img/logo_principal.png') }}" class="logo" alt="">
            <h3 class="fecha">{{ $fechaActual }}</h3>
        </div>
        <br><br><br><br><br><br>
        @foreach ($empleados as $empleado)
            <p>Señor (a):</p>
            <h4>{{ $empleado->nombre ?? '' }}</h4>
            <p>Ref-:Entrega de: </p>
            <h4>Activos</h4>
            <p>Distinguido Señor (a):</p>
            <p>Adjunto hacemos entrega de los siguientes activos, como parte de su dotación laboral:</p>
            @if (count($resultados) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serial</th>
                            <th>N° Activo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resultados as $resultado)
                            @if ($resultado->cpu_id)
                                @php
                                    $equipos = explode(',', $resultado->cpu_id);
                                    $categorias1 = explode(',', $resultado->cpu_categoria);
                                    $marcas = explode(',', $resultado->cpu_marca);
                                    $series = explode(',', $resultado->cpu_serie);
                                    $seriales = explode(',', $resultado->cpu_serial);
                                    $activos = explode(',', $resultado->n_activo);
                                @endphp
                                @foreach ($equipos as $key => $equipo)
                                    <tr>
                                        <td>{{ $categorias1[$key] ?? '' }}</td>
                                        <td>{{ $marcas[$key] ?? '' }}</td>
                                        <td>{{ $series[$key] ?? '' }}</td>
                                        <td>{{ $seriales[$key] ?? '' }}</td>
                                        <td>{{ $activos[$key] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            @if ($resultado->accesorio_id)
                                @php
                                    $accesorios = explode(',', $resultado->accesorio_id);
                                    $categorias2 = explode(',', $resultado->accesorio_categoria);
                                    $marcas2 = explode(',', $resultado->accesorio_marca);
                                    $series = explode(',', $resultado->accesorio_serie);
                                    $seriales = explode(',', $resultado->accesorio_n_serial);
                                @endphp
                                @foreach ($accesorios as $key => $accesorio)
                                    <tr>
                                        <td>{{ $categorias2[$key] ?? '' }}</td>
                                        <td>{{ $marcas2[$key] ?? '' }}</td>
                                        <td>{{ $series[$key] ?? '' }}</td>
                                        <td>{{ $seriales[$key] ?? '' }}</td>
                                        <td>N/A</td>
                                    </tr>
                                @endforeach
                            @endif
                            @if ($resultado->telefono_id)
                                @php
                                    $telefonos = explode(',', $resultado->telefono_id);
                                    $categorias3 = explode(',', $resultado->telefono_categoria);
                                    $marcas3 = explode(',', $resultado->telefono_marca);
                                    $modelo = explode(',', $resultado->telefono_modelo);
                                    $serial = explode(',', $resultado->telefono_serial);
                                @endphp
                                @foreach ($telefonos as $key => $telefono)
                                    <tr>
                                        <td>{{ $categorias3[$key] ?? '' }}</td>
                                        <td>{{ $marcas3[$key] ?? '' }}</td>
                                        <td>{{ $modelo[$key] ?? '' }}</td>
                                        <td>{{ $serial[$key] ?? '' }}</td>
                                        <td>N/A</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No se encontraron activos asignados para este empleado.</p>
            @endif
            <br><br>
            <div style="page-break-inside: avoid;">
                <p>El usuario es responsable del adecuado manejo y cuidado de los activos entregados. En caso de pérdida
                    total o parcial, el usuario deberá cubrir los costos correspondientes. Asimismo, cualquier daño
                    causado por un mal uso del activo será responsabilidad
                    del usuario y tendra que pagar el valor deducible de los daños causados.</p>
                <p>Agradecemos su atención y colaboración.</p>
                <p>Atentamente.</p>
                <div style="float: left;">
                    <p style="font-size: 16px;"> <b>Freddy Javier Alonso </b><br>
                        ADMINISTRATIVE DIRECTOR</p>
                    <p style="font-size: 13px;">FIRMA _____________________________ <br><br>
                        C.C ________________________________</p>
                </div>
                <div style="float:right; text-align: left;">
                    <p style="font-size: 14px;"> <b>{{ $empleado->nombre ?? '' }}</b> <br>
                        {{ $empleado->cargos->nombre ?? '' }}</p>
                    <p style="font-size: 13px;">FIRMA __________________________________ <br><br>
                        C.C _____________________________________</p>
                </div>
            </div>
        @endforeach
    </main>
</body>

</html>
