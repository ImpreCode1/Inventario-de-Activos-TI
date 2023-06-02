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
    </style>
</head>

<body class="cuerpo">
    <main>
        <br>
        <div>
            <img src="{{ public_path('/img/logo_principal.png') }}" class="logo" alt="">
            <h3 class="fecha">{{ $fechaActual }}</h3>
        </div>
        <br><br><br><br><br><br><br>
        @foreach ($softwares as $software)
            <p>Distinguido Señor (a):</p>
            <p> <strong> {{ $software->empleado->nombre ?? '' }}</strong></p>
            <p>Bogotá D.C.</p>
            <p>Ref.-: Usuario administrador</p>
            <br>
            <div>
                <p>Dada su solicitud para tener usuario administrador y luego de haber sido configurado el mismo, se
                    entiende que el usuario se hace responsable de:</p>
                <ol>
                    <li>Seguir los lineamientos de la empresa en cuanto a licenciamiento.</li>
                    <li>No hacer uso de software que pueda comprometer el funcionamiento del sistema.</li>
                    <li>No realizar configuraciones que hagan inoperantes los sistemas de seguridad con los que cuenta
                        la empresa.</li>
                    <li>No desinstalar ninguno de los programas con los que se entrega el equipo.</li>
                    <li>No realizar configuraciones adicionales en el archivo host.</li>
                    <li>No modificar las configuraciones básicas de red.</li>
                    <li>No modificar el regedit.</li>
                </ol>
                <p>En caso de ir en contravía de estos compromisos, se procederá a imponer un memorando por falta grave,
                    con copia a la hoja de vida.</p>
                    <br>
                <p>Agradezco su amable y acostumbrada atención.</p>
            </div>
            <p>Atentamente.</p>
            <div style="display: flex; align-items: center;">
                <div style="float: left;">
                    <p style="font-size: 16px;"> <b>Freddy Javier Alonso </b><br>
                        Coordinador de Infraestructura</p>
                    <p style="font-size: 13px;">FIRMA _____________________________ <br><br>
                        C.C ________________________________</p>
                </div>
                <div style="float:right; text-align: left;">
                <p style="font-size: 14px;"> <b>{{ $software->empleado->nombre ?? '' }}</b> <br>
                    {{ $software->empleado->cargos->nombre ?? '' }}</p>
                <p style="font-size: 13px;">FIRMA __________________________________ <br><br>
                C.C _____________________________________</p>
                </div>
        </div>
        @endforeach
    </main>
</body>
</html>
