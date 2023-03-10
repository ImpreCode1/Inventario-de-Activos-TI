@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inventarios de Accesorios</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <a href="accesorios/create" class="btn btn-primary">CREAR</a>
    <p></p>
    <table id="accesorios" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Categoria</th>
                <th scope="col">Marca</th>
                <th scope="col">N° de Serial</th>

                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($accesorios as $accesorio)
            <tr>
                <td>{{ $accesorio->id }}</td>
                <td>{{ $accesorio->empleado->nombre }}</td>
                <td>{{ $accesorio->categoria->nombre }}</td>
                <td>{{ $accesorio->marca->marca }}</td>
                <td>{{ $accesorio->n_serial }}</td>
                <td>
                    <form action="{{ route ('accesorios.destroy', $accesorio->id) }}" method="POST">
                    <a  href="/accesorios/{{ $accesorio->id }}/edit" class="btn btn-info">Editar</a>
                    
                    @csrf
                    @method('DELETE')
                    <Button type="submit" class="btn btn-danger">Eliminar</Button>
                </form>
                </td>
            </tr>
                
            @endforeach

        </tbody>
    </table>
</div>
</div>
@stop



@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
    $('#accesorios').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrar la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Filtrado de  _MAX_ Registros totales)",
            "search":"Buscar",
            "paginate" :{
            "next":"Siguiente",
            "previous":"Anterior"
            }
        }
    });
});
</script>
@stop