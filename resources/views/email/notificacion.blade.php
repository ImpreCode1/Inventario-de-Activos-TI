<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
       .fcc-btn {
        padding: 8px 16px; /* Añade un poco de espacio alrededor del texto */
        border-radius: 4px; /* Hace las esquinas del botón un poco más redondeadas */
        text-decoration: none; /* Quita el subrayado del texto del enlace */
        },
        p {
        font-size: 16px;
        color: #333;
        line-height: 1.5;
        font-family: Arial, sans-serif;
        margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <main>
        <h3>¡Hola!</h3>
        <p>Espero que se encuentre bien. Se informa sobre un nuevo registro de un nuevo Equipo en la página de inventario del Área de Tecnología y se solicita su colaboración en el proceso de registro del equipo en nuestro sistema de inventario.</p>
        <p>El equipo se le asigno a: <strong>{{ $equipos->empleado->nombre }}</strong>.</p>
        <p>Ingresando el <b>NUMERO DE ACTIVO</b> que está actualmente como <b>{{ $equipos->n_activo }}</b>, y también el <b>COSTO DEL EQUIPO</b>, que también está registrado como: <b>{{ $equipos->costo }}.</b></p>
        <p>Para ingresar es necesario que se dirija a la página de Inventario de Tecnología e INICIE SESIÓN. Después se dirija a la sección de INVENTARIO ACTIVOS - INVENTARIO - Portátiles y CPUS.</p>
        <p>O, puede ingresar por medio del siguiente enlace al formulario del Equipo recién creado en el inventario:</p>
        <center><a class="fcc-btn btn-primary" target="_blank" href="{{$url_edicion}}" role="button">Ir al formulario del Equipo Creado</a></center>
        <br>
        <p>Los datos con los que fue registrado el equipo por el personal de Infraestructura son los siguientes:</p>
        <ol>
            <li>Nombre: <b>{{ $equipos->empleado->nombre }}</b></li>
            <li>Categoría: <b>{{ $equipos->categoria->nombre }}</b></li>
            <li>Marca: <b>{{ $equipos->marca->marca }}</b></li>
            <li>Modelo: <b>{{ $equipos->serie }}</b></li>
            <li>Número de Serie: <b>{{ $equipos->n_serial }}</b></li>
            <li>Procesador: <b>{{ $equipos->procesador }}</b></li>
            <li>Memoria RAM: <b>{{ $equipos->memoria_ram }}</b></li>
            <li>Disco duro: <b>{{ $equipos->discoduro }}</b></li>
        </ol>
        <p>Su colaboración es fundamental para mantener nuestro sistema de inventario actualizado y asegurarnos de que nuestros activos estén protegidos. Si tiene alguna pregunta o necesita ayuda en el proceso, no dude en ponerse en contacto con nuestro equipo de tecnología.</p>
        <p>Atentamente,</p>
        <p>SOPORTE IT</p>
    </main>
</body>

</html>
