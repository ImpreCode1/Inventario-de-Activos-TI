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
        <br>
        <div>
            <img src="{{ public_path('/img/logo_principal.png') }}" class="logo" alt="">
            <h3 class="fecha">{{ $fechaActual }}</h3>
        </div>
        <br><br><br><br><br><br>
        @foreach ($celulares as $celular)
            <p>Señor (a):</p>
            <h4>{{ $celular->empleado->nombre ?? '' }}</h4>
            <p>Se le hace entrega de los siguientes elementos:</p>
            <table>
                <tr>
                    <td>Apellidos y Nombres</td>
                    <td>{{ $celular->empleado->nombre ?? '' }}</td>
                </tr>
                <tr>
                    <td>Cedula</td>
                    <td>{{$celular->cedula}}</td>
                </tr>
                <tr>
                    <td>Cargo</td>
                    <td>{{ $celular->empleado->cargos->nombre ?? '' }}</td>
                </tr>
                <tr>
                    <td>Departamento</td>
                    <td>{{ $celular->empleado->departamentos->nombre ?? '' }}</td>
                </tr>
                <tr>
                    <td>Linea Celular</td>
                    <td>{{ $celular->operador ?? '' }}</td>
                </tr>
                <tr>
                    <td>Observación</td>
                    <td>{{ $celular->observaciones ?? '' }}</td>
                </tr>
                <tr>
                    <td>Carne</td>
                    <td>SI</td>
                </tr>
                <tr>
                    <td>Plan</td>
                    <td>Corporativo</td>
                </tr>
                <tr>
                    <td>Recursos</td>
                    <td>Minutos Ilimitados</td>
                </tr>
            </table>
            <br>
            <p>Para uso corporativo, por tanto, usted se compromete a garantizar la custodia y buen manejo de esta. La pérdida o daño queda bajo su 
                responsabilidad y debe ser reportado de manera inmediata a Internal Supply de <b>Impresistem S.A.S.</b></p>
            <p>En caso de retiro, debe ser devuelto a la compañía en perfecto estado y tal como se le entregó, salvo el deterioro por el uso normal del equipo.</p>
            <p>Agradezco su amable atención</p>
            <p>Atentamente.</p>
            <br>
            <div style="display: flex; align-items: center;">
                <div style="float: left;">
                    <p style="font-size: 16px;"> <b>{{$nombreUsuario}}</b><br><br>
                        INTERNAL SUPPLY SUPPORT</p>
                </div>
                <div style="float:right; text-align: left;">
                    <p style="font-size: 14px;"> <b>FIRMA</b><br><br>
                        RECIBE: </p>
                    <p style="font-size: 13px;">__________________________________ <br><br>
                    C.C </p>
                </div>
            </div>
        @endforeach
    </main>
</body>
</html>