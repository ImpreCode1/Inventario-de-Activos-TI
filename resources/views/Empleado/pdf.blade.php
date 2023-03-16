<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    @foreach ($empleados as $empleado)
    <main>
        <h1>Nombre: {{ $empleado->nombre }} <br>
            {{$empleado->departamentos->nombre }}
    </main>
    @endforeach
</body>

</html>
