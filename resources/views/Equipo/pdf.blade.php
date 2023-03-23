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
        <br><br><br><br><br><br>
        @foreach ($equipos as $equipo)
            <p>Señor (a):</p>
            <h4>{{ $equipo->empleado->nombre ?? 'El empleado no existe' }}</h4>
            <p>Entrega de: {{ $equipo->categoria->nombre ?? 'No existe' }}</p>
            <p>Distinguido Señor (a):</p>
            <p>Adjunto hacemos entrega de un(a) {{ $equipo->categoria->nombre ?? 'No existe' }} con las
                siguientes caracteristicas como parte de su dotación
                laboral.</p>
            <table>
                <tr>
                    <td>Categoria</td>
                    <td>Marca</td>
                    <td>Modelo</td>
                    <td>N° de Serial</td>
                    <td>N° de Activo</td>
                    <td>RAM</td>
                    <td>Procesador</td>
                    <td>Disco Duro</td>
                </tr>
                <tr>
                    <td>{{ $equipo->categoria->nombre ?? '' }}</td>
                    <td>{{ $equipo->marca->marca ?? '' }}</td>
                    <td>{{ $equipo->serie ?? '' }}</td>
                    <td>{{ $equipo->n_serial ?? '' }}</td>
                    <td>{{ $equipo->n_activo ?? '' }}</td>
                    <td>{{ $equipo->memoria_ram ?? '' }}</td>
                    <td>{{ $equipo->procesador ?? '' }}</td>
                    <td>{{ $equipo->discoduro ?? '' }}</td>
                </tr>
            </table>
            <br>
            <p>Dicho equipo puede ser utilizado de acuerdo a sus criterios en pro de los trabajos derivados de su
                actividad dentro de la compañía.
            </p>
            <br>
            <p>La responsabilidad del manejo adecuado del mismo y de la pérdida total o parcial del mismo es
                del usuario. El equipo se encuentra asegurado, en caso de pérdida cuando este sea retirado de la
                compañía, el usuario deberá pagar el valor deducible del seguro</p>
            <br>
            <p>Agradezco su amable y acostumbrada atención <br>
                Atentamente.
            </p>
            <br><br><br>
            <div style="display: flex; align-items: center;">
                <div style="float: left;">
                    <p><strong> Freddy Javier Alonso </strong></p>
                    <p>Ingeniero de Soporte</p>
                    <p>FIRMA ________________________</p>
                    <p>C.C ___________________________</p>
                </div>
                <div style="float:right; text-align: left;">
                    <p> <strong> {{$equipo->empleado->nombre ?? '' }}</strong></p>
                    <p>{{ $equipo->empleado->cargos->nombre ?? ''}}</p>
                    <p>FIRMA _____________________________</p>
                    <p>C.C ________________________________</p>
                </div>
            </div>
        @endforeach
    </main>

</body>

</html>
