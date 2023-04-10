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
            width: 250px;
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
			font-size: 14px; 
		}
		td, th {
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
            <img src="{{ public_path('/img/LogoIMpreAltaconfondo.jpg') }}" class="logo" alt="">
            <h3 class="fecha">{{ $fechaActual }}</h3>
        </div>
        <br><br><br><br><br>
        <strong> Señor (a): <br> Cristina Garzon <br>
        Logistica </strong>
        <br> <br>
        <p> <b>Asunto:</b>  Envío de herramienta(s) de trabajo. <br>
        <b>Entrega a:</b>                <br>
        <b> Direccion:</b>               <br>
        <b> Contacto:</b>                </p>
        @if(count($resultados) > 0)
                <p>Acontinuacion, relaciono la(s) herramientas de trabajo:</p>
                <table>
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serial</th>
                            <th>Plaqueta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resultados as $resultado)
                        @if($resultado->cpu_id)
                        @php
                            $equipos= explode(',', $resultado->cpu_id);
                            $categorias1 = explode(',', $resultado->cpu_categoria);
                            $marcas = explode(',', $resultado->cpu_marca);
                            $series = explode(',', $resultado->cpu_serie);
                            $seriales = explode(',', $resultado->cpu_serial);
                            $activos = explode(',', $resultado->n_activo);
                        @endphp
                        @foreach($equipos as $key => $equipo)
                            <tr>
                                <td>{{$categorias1[$key] ?: ''}}</td>
                                <td>{{$marcas[$key] ?: ''}}</td>
                                <td>{{$series[$key] ?: ''}}</td>
                                <td>{{$seriales[$key] ?: ''}}</td>
                                <td>{{$activos[$key] ?: ''}}</td>
                            </tr>
                        @endforeach
                        @endif
                            @if($resultado->accesorio_id)
                            @php
                                $accesorios = explode(',', $resultado->accesorio_id);
                                $categorias2 = explode(',', $resultado->accesorio_categoria);
                                $marcas2 = explode(',', $resultado->accesorio_marca);
                                $series = explode(',', $resultado->accesorio_serie);
                                $seriales = explode(',', $resultado->accesorio_n_serial);
                            @endphp
                            @foreach($accesorios as $key => $accesorio)
                                <tr>
                                    <td>{{$categorias2[$key] ?: ''}}</td>
                                    <td>{{$marcas2[$key] ?: ''}}</td>
                                    <td>{{$series[$key] ?: ''}}</td>
                                    <td>{{$seriales[$key] ?: ''}}</td>
                                    <td>N/A</td>
                                </tr>
                            @endforeach
                        @endif
                            @if($resultado->telefono_id)
                            @php
                                    $telefonos = explode(',', $resultado->telefono_id);
                                    $categorias3 = explode(',', $resultado->telefono_categoria);
                                    $marcas3 = explode(',', $resultado->telefono_marca);
                                    $modelo = explode(',', $resultado->telefono_modelo);
                                    $serial = explode(',', $resultado->telefono_serial);
                            @endphp
                            @foreach($telefonos as $key => $telefono)
                            <tr>
                                <td>{{$categorias3[$key] ?: ''}}</td>
                                <td>{{$marcas3[$key] ?: ''}}</td>
                                <td>{{$modelo[$key] ?: ''}}</td>
                                <td>{{$serial[$key] ?: ''}}</td>
                                <td>N/A</td>
                            </tr>
                            @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No se encontraron equipos y accesorios asignados para este empleado.</p>
            @endif
            <br>
            <p>Se eniva el equipo a NOMBRE EMPLEADO, como parte de su dotacion laboral, las herramientas de trabajo se entregan en perfectas condiciones.
            </p>
            <p>Nota: Por favor firmar carta de eresponsabilidad anexa al envio y renviarla o escanearla al correo soporteit@impresistem.com.
            </p>
            <p>Agradezco su amable y acostumbrada atención</p>
            <p>Atentamente.</p>
            <div style="display: flex; align-items: center;">
                <div style="float: left;">
                    <p><strong> Freddy Javier Alonso </strong></p>
                    <p>Ingeniero de Soporte</p>
                    <p>FIRMA ________________________</p>
                    <p>C.C ___________________________</p>
                </div>
            </div>
    </main>
</body>
</html>
