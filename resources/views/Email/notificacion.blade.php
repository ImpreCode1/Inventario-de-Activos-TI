<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Equipo registrado en el Inventario de Tecnologia</h1>

<p></p>

<li>Nombre: {{ $equipos->empleado->nombre }}</li>
<li>Categoria: {{$equipos->categoria->nombre}}</li>
<li>Modelo: {{$equipos->serie}}</li>
<li>Serial: {{$equipos->n_serial}}</li>
<li>El numero de activo no esta asignado: {{$equipos->n_activo}}</li>


</body>
</html>