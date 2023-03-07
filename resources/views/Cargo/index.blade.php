@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registro de Cargos</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <a href="cargos/create" class="btn btn-primary">CREAR</a>
    <p></p>
    <table id="cargos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cargo</th>
                <th scope="col">Detalle</th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($cargos as $cargo)
            <tr>
                <td>{{ $cargo->id }}</td>
                <td>{{ $cargo->cargo }}</td>
                <td>{{ $cargo->detalle }}</td>
                <td>
                    <form action="{{ route ('cargos.destroy', $cargo->id) }}" method="POST">
                    <a  href="/cargos/{{ $cargo->id }}/edit" class="btn btn-info">Editar</a>
                    
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
    $('#cargos').DataTable({
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