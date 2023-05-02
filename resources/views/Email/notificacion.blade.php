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
        <p>Espero que se encuentre bien. Se informa sobre un nuevo registro de un nuevo Equipo en
            la pagina de inventario del Area de Tecnologia y se solicita su colaboración en el proceso de registro
            del equipo en nuestro sistema de inventario. Ingresando el <b>NUMERO DE ACTIVO</b> que esta actualmente como
            <b>{{ $equipos->n_activo }}</b>,
            y tambien el <b>COSTO DEL EQUIPO</b>, que tambien esta registrado como: <b>{{ $equipos->costo }}.</b></p>
        <p>Para ingresar es necesario que se dirija a la pagina de Inventario de Tecnologia y INICIE SECIÓN.
            Despues se dirija a la seccion, de INVENTARIO ACTIVOS - INVENTARIO - Portatiles y CPUS. </p>
        <p>O, puede ingresar por medio de la siguiente enlace a el inventario de EQUIPOS:</p>
        <center><a class="fcc-btn" target="_blank" class="btn-primary" href="{{ route('equipos.index') }}" role="button">Ira la página de Equipos</a></center>
        <br>
        <p>El equipo fue registrado a la persona <strong>{{ $equipos->empleado->nombre }}</strong>, y puede buscar el
            equipo en la tabla con alguno de los siguientes datos con los que fue registrado el equipo:
        </p>

        <ol>
            <li>Nombre: <b>{{ $equipos->empleado->nombre }}</b></li>
            <li>Categoria: <b>{{ $equipos->categoria->nombre }}</b></li>
            <li>Categoria: <b>{{ $equipos->marca->marca }}</b></li>
            <li>Categoria: <b>{{ $equipos->categoria->nombre }}</b></li>
            <li>Modelo: <b>{{ $equipos->serie }}</b></li>
            <li>Numero de Serial: <b>{{ $equipos->n_serial }}</b></li>
            <li>Procesador: <b>{{ $equipos->procesador }}</b></li>
            <li>Memoria RAM: <b>{{ $equipos->memoria_ram }}</b></li>
            <li>Discoduro: <b>{{ $equipos->discoduro }}</b></li>
        </ol>
        <p>Es necesario, que cuandoo identifique el equipo, presione el boton 'EDITAR', y ingrese al formulario del
            equipo,
            y edite los campos de
            <b>NUMERO DE ACTIVO</b> que esta como: <b>{{ $equipos->n_activo }}</b>, y el <b>COSTO DEL EQUIPO:</b> que
            esta como: <b>{{ $equipos->costo }}</b>
        </p>
        <p>Su colaboración es fundamental para mantener nuestro sistema de inventario actualizado y asegurarnos de que
            nuestros activos estén protegidos. Si tiene alguna pregunta o necesita ayuda en el proceso,
            no dude en ponerse en contacto con nuestro equipo de tecnología.</p>
        <p>Atentamente,</p>
        <p>SOPORTE IT</p>
    </main>
</body>

</html>
