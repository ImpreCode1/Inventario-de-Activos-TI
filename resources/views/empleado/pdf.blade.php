<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">

</head>

<body style=" margin: 15mm 20mm 5mm 8mm;">
    @foreach ($empleados as $empleado)
        <main>
            <div>
                <img src="{{ public_path('/img/logo_principal.png') }}" style="width:250px; float:center"
                    alt="">
                <h3 style="text-align:center">
                    Departamento De Tecnologia <br>
                    Acta de Entrega de Usuarios y Contraseñas <br>
                    INFORMACION BASICA DE USUARIO
                </h3>
                <br>
                <br>
                <img src="{{ public_path('/img/Screenshot_1.png') }}" alt="" width="1000px">
                <br>
                <div style=" border: 1px solid #000000;   width:1000px">
                    <br>
                   <table style="border: hidden; width: 100%;
                   height: 300px;" >
                    <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                    </tr>
                    <tr>
                    <td><div style="padding-bottom:-5px; padding-left: 10px;"> <b> Nombre :</b><br>{{ $empleado->nombre ?? ' '}} </div></td>
                    <td><div style="padding-bottom:-5px; padding-left: 10px;"><b>N° Extencion:</b><br>{{$empleado->num_exten ?? ' '}}</div></td>
                    <td><div style="padding-bottom:-5px; padding-left: 10px;"><b>Usuario SAP:</b><br>Asignada por el Area de Desarrollo</div></td>
                    </tr>
                    <tr>
                    <td><div style="padding-top: 20px; padding-left: 10px;"><b>Email :</b><br>{{ $empleado->email ?? ' '}}</div></td>
                    <td><div style="padding-top: 20px; padding-left: 10px"><b>Usuario Office:</b><br>{{$empleado->email ?? ' '}}</div></td>
                    <td><div style="padding-top: 20px; padding-left: 10px;"><b>Clave Incial SAP</b><br>Asignada por el Area de Desarrollo</div></td>
                    </tr>
                    <tr>
                    <td><div style="padding-top: 20px; padding-left: 10px"><b>Usuario Dominio:</b><br>{{$empleado->usu_dominio ?? ' '}}</div></td>
                    <td><div style="padding-top: 20px; padding-left: 10px"><b>Clave Office:</b><br>{{$empleado->clave_dominio ?? ' '}}</div></td>
                    </tr>
                    <tr>
                    <td><div style="padding-top: 20px; padding-left: 10px"><b>Clave Dominio:</b><br>{{$empleado->clave_dominio ?? ' '}}</div></td>
                    </tr>
                </table>
                <div style="text-align: center">
                    <div style="display: inline-block; margin-right: 10px; text-align: left;">Firma: _______________________</div>
                    <div style="display: inline-block; text-align: left;">C.C: _______________________</div>
                  </div>
                  <br>
                  <br>
                  <br>
                  <center>
                    <div class="inf"><center class="style4"><em>ESTA INFORMACIÓN ES PERSONAL Y CONFIDENCIAL, EL ADECUADO USO DE LA MISMA ES SU RESPONSABILIDAD.</em></center><em>
                    <center class="style4">
                <br>
                </div>
        </main>
    @endforeach
</body>

</html>
