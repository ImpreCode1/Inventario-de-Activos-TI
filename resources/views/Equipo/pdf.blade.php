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
        <div>
            <img src="{{ public_path('/img/LogoIMpreAltaconfondo.jpg') }}" class="logo" alt="">
            <h3 class="fecha">{{ $fechaActual }}</h3>
        </div>
        <br><br><br><br><br><br>
        @foreach ($equipos as $equipo)
            <p>Señor (a):</p>
            <h4>{{ $equipo->empleado->nombre ?? '' }}</h4>
            <p>Ref-:Entrega de: </p>
            <h4>{{ $equipo->categoria->nombre ?? '' }}</h4>
            <p>Distinguido Señor (a):</p>
            <p>Adjunto hacemos entrega de un(a) {{ $equipo->categoria->nombre ?? '' }} con las
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
            <p>La responsabilidad del manejo adecuado del mismo y de la pérdida total o parcial del mismo es
                del usuario. El equipo se encuentra asegurado, en caso de pérdida, el usuario debera pagar el valor deducible
                del seguro. En caso de averia por daños causados por el ususario, el costo de los repuestos sera asumido por el ususario.
            </p>
            <p>Agradezco su amable y acostumbrada atención </p>
            <p>Atentamente.</p>
            <div style="float: left;">
                <p style="font-size: 16px;"> <b>Freddy Javier Alonso </b><br>
                Ingeniero de Soporte</p>
                <p style="font-size: 13px;">FIRMA _____________________________ <br><br>
                    C.C ________________________________</p>
            </div>
            <div style="float:right; text-align: left;">
                <p style="font-size: 14px;"> <b>{{$equipo->empleado->nombre ?? '' }}</b> <br>
                {{ $equipo->empleado->cargos->nombre ?? ''}}</p>
                <p style="font-size: 13px;">FIRMA __________________________________ <br><br>
                C.C _____________________________________</p>
            </div>
            
        @endforeach
    </main>
</body>
</html>
