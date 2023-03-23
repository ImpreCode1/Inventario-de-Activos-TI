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
        @foreach ($accesorios as $accesorio)
            <p>Señor (a):</p>
            <h4>{{ $accesorio->empleado->nombre ?? 'El empleado no existe' }}</h4>
            <p>Entrega de: </p>
            <h4>{{ $accesorio->categoria->nombre ?? 'No existe' }}</h4>
            <p>Distinguido Señor (a):</p>
            <p>Adjunto hacemos entrega de un(a) {{ $accesorio->categoria->nombre ?? 'No existe' }} con las
                siguientes caracteristicas como parte de su dotación
                laboral.</p>
            <table>
                <tr>
                    <td>Categoria</td>
                    <td>Marca</td>
                    <td>Modelo</td>
                    <td>N° de Serial</td>
                    <td>N° de Activo</td>
                    <td>N° Parte</td>
                </tr>
                <tr>
                    <td>{{ $accesorio->categoria->nombre ?? '' }}</td>
                    <td>{{ $accesorio->marca->marca ?? '' }}</td>
                    <td>{{ $accesorio->serie ?? '' }}</td>
                    <td>{{ $accesorio->n_serial ?? '' }}</td>
                    <td>{{ $accesorio->n_activo ?? '' }}</td>
                    <td>{{ $accesorio->n_parte ?? '' }}</td>
                </tr>
            </table>
            <br>
            <p>Dicho accesorio puede ser utilizado de acuerdo a sus criterios en pro de los trabajos derivados de su
                actividad dentro de la compañía.
            </p>
            <br>
            <p>La responsabilidad del manejo adecuado del mismo y de la pérdida total o parcial del mismo es
                del usuario. El accesorio se encuentra asegurado, en caso de pérdida cuando este sea retirado de la
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
                    <p> <strong> {{$accesorio->empleado->nombre ?? '' }}</strong></p>
                    <p>{{ $accesorio->empleado->cargos->nombre ?? ''}}</p>
                    <p>FIRMA _____________________________</p>
                    <p>C.C ________________________________</p>
                </div>
            </div>
        @endforeach
    </main>
</body>
</html>
