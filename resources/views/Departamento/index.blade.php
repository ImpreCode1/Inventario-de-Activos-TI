@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Departamentos')

@section('content_header')
    <h1>Registro de Departamentos</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <a href="departamentos/create" class="btn btn-primary">CREAR</a>
    <p></p>
    <table id="departametos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cargo</th>
                <th>Acciones</th>       
            </tr>
        </thead>
        <tbody>
            @foreach ($departamentos as $departamento)
            <tr>
                <td>{{ $departamento->id }}</td>
                <td>{{ $departamento->nombre ?? 'El departamento no existe' }}</td>
                <td>
                    <form action="{{ route ('departamentos.destroy', $departamento->id) }}" method="POST">
                    <a  href="/departamentos/{{ $departamento->id }}/edit" class="btn btn-info btn-sm">Editar</a>
                    @csrf
                    @method('DELETE')
                    <Button type="submit" class="btn btn-danger btn-sm">Eliminar</Button>
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
    $('#departametos').DataTable({
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