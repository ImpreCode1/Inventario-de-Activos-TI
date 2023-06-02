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
            <img src="{{ public_path('/img/logo_principal.png') }}" class="logo" alt="">
            <h3 class="fecha">{{ $fechaActual ?? '' }}</h3>
        </div>
        <br><br><br><br><br><br><br>
        <strong> Señor (a): <br>{{ $encargado->encargado_bodega }}<br>
        Logistica </strong>
        <br><br><br>
        @foreach ($memorandos as $memorando)
        <p> <b>Asunto:</b>  Envío de herramienta(s) de trabajo. <br>
        <b>Entrega a: </b> {{$memorando->empleado->nombre ?? ''}}  <br>
        <b> Direccion:</b> {{$memorando->direccion ?? ''}}              <br>
        <b> Contacto:</b> {{$memorando->n_contacto ?? ''}}              </p>
        @if(count($resultados) > 0)
                <p>Acontinuacion, relaciono la(s) herramienta(s) de trabajo:</p>
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
                                <td>{{$categorias1[$key] ?? ''}}</td>
                                <td>{{$marcas[$key] ?? ''}}</td>
                                <td>{{$series[$key] ?? ''}}</td>
                                <td>{{$seriales[$key] ?? ''}}</td>
                                <td>{{$activos[$key] ?? ''}}</td>
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
                                    <td>{{$categorias2[$key] ?? ''}}</td>
                                    <td>{{$marcas2[$key] ?? ''}}</td>
                                    <td>{{$series[$key] ?? ''}}</td>
                                    <td>{{$seriales[$key] ?? ''}}</td>
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
                                <td>{{$categorias3[$key] ?? ''}}</td>
                                <td>{{$marcas3[$key] ?? ''}}</td>
                                <td>{{$modelo[$key] ?? ''}}</td>
                                <td>{{$serial[$key] ?? ''}}</td>
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
            <p>Se eniva(n) la(s) herramienta(s) a <b>{{$memorando->empleado->nombre ?? ''}}</b>, como parte de su dotacion laboral, la(s) herramienta(s) de trabajo se entregan en perfectas condiciones.
            </p>
            <p>Nota: Por favor firmar carta de responsabilidad anexa al envio y renviarla o escanearla al correo <b>{{$memorando->correo_encargado ?? ''}}</b>
            </p>
            <p>Agradezco su amable y acostumbrada atención</p>
            <p>Atentamente.</p>
            <div style="display: flex; align-items: center;">
                <div style="float: left;">
                    <p><b>Freddy Javier Alonso<br>
                    Ingeniero de Soporte<br>
                    IMPRESISTEM S.A.S
                    </b>
                </p>
                </div>
            </div>
        @endforeach
    </main>
</body>
</html>
