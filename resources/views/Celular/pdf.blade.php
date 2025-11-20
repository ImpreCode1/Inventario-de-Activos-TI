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
            margin: 1cm;
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
            <h4>{{ $celular->empleado->nombre ?? 'El empleado no existe' }}</h4>
            <p>Entrega de: </p>
            <h4>{{ $celular->categoria->nombre ?? 'No existe' }}</h4>
            <p>Distinguido Señor (a):</p>
            <p>Adjunto hacemos entrega de un(a) {{ $celular->categoria->nombre ?? 'No existe' }} con las
                siguientes caracteristicas como parte de su dotación
                laboral.</p>
            <table>
                <tr>
                    <td>Marca</td>
                    <td>Modelo</td>
                    <td>N° Telefono</td>
		    <td>Serial</td>
                    <td>IMEI 1</td>
                    <td>IMEI 2</td>
                    <td>RAM</td>
                    <td>Memoria</td>
                </tr>
                <tr>
                    <td>{{ $celular->marca->marca ?? '' }}</td>
                    <td>{{ $celular->modelo ?? '' }}</td>
                    <td>{{ $celular->n_telefono ?? '' }}</td>
                    <td>{{ $celular->serial ?? '' }}</td>
                    <td>{{ $celular->email_1 ?? '' }}</td>
                    <td>{{ $celular->email_2 ?? '' }}</td>
                    <td>{{ $celular->ram ?? '' }}</td>
                    <td>{{ $celular->rom ?? '' }}</td>
                </tr>
            </table>
            <br>
            <p>Dicho celular puede ser utilizado de acuerdo a sus criterios en pro de los trabajos derivados de su
                actividad dentro de la compañía.
            </p>
            <p>El usuario es responsable del manejo adecuado del equipo y de cualquier pérdida total o parcial del mismo. 
		Si el equipo sufre daños debido a mal uso o negligencia que requieran reparación o reemplazo de piezas, en la primera incidencia 
		el usuario asumirá el 50% del costo, mientras que la empresa cubrirá el 50% restante. En una segunda incidencia o posteriores, 
		el usuario será responsable del 100% del costo. En caso de pérdida o robo, el usuario deberá cubrir el 100% del deducible 
		correspondiente al seguro vigente del equipo, sin excepciones.
            </p>
            <br>
            <p>Agradezco su amable y acostumbrada atención</p>
            <p>Atentamente.</p>
            <br>
            <div style="display: flex; align-items: center;">
                <div style="float: left;">
                    <p style="font-size: 16px;"> <b>FREDDY JAVIER ALONSO </b><br>
                    ADMINISTRATIVE DIRECTOR</p>
                    <p style="font-size: 13px;">FIRMA _____________________________ <br><br>
                        C.C ________________________________</p>
                </div>
                <div style="float:right; text-align: left;">
                    <p style="font-size: 14px;"> <b>{{$celular->empleado->nombre ?? '' }}</b> <br>
                        {{ $celular->empleado->cargos->nombre ?? ''}}</p>
                    <p style="font-size: 13px;">FIRMA __________________________________ <br><br>
                    C.C _____________________________________</p>
                </div>
            </div>
        @endforeach
    </main>
</body>
</html>