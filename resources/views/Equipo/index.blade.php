@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inventarios de Equipos</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <a href="equipos/create" class="btn btn-primary">CREAR</a>
    <p></p>
    <table id="equipos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Categoria</th>
                <th scope="col">Marca</th>
                <th scope="col">N° de Activo</th>
                <th scope="col">N° de Serial</th>
                <th>Acciones</th>
                

                {{-- <th>Acciones</th> --}}
                
            </tr>
        </thead>
        <tbody>
         {{--    @foreach ($equipos as $equipo)
            <tr>
                <td>{{ $equipo->id }}</td>
                <td>{{ $equipo->empleado->nombre ?? 'El empleado no existe'}}</td>
                <td>{{ $equipo->categoria->nombre ?? 'La categoria no existe'}}</td>
                <td>{{ $equipo->marca->marca ?? 'La marca no Existe'}}</td>
                <td>{{ $equipo->n_serial ?? 'No existe numero de serial'}}</td>
                <td>
                    <form action="{{ route ('equipos.destroy', $equipo->id) }}" method="POST">
                    <a  href="/equipos/{{ $equipo->id }}/edit" class="btn btn-info btn-sm">Editar</a>
                    <a href="/equipos/{{$equipo->id}}/pdf" target="_blank" class="btn btn-success btn-sm">Responsabilidad usu</a>
                    @csrf
                    @method('DELETE')
                    <Button type="submit" class="btn btn-danger btn-sm">Eliminar</Button>
                </form>
                </td>
            </tr>
                
            @endforeach --}}
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
    function confirmDelete(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este Equipo?')) {
            $('#form-eliminar-' + id).submit();
        }
    }
</script>
<script>
    $(document).ready(function () {
    $('#equipos').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('equipos.lista') }}",
        columns: [
        {data: 'id'},
        {data: 'empleado.nombre', name: 'empleado.nombre', defaultContent: ''},
        {data: 'categoria.nombre', name:'categoria.nombre', defaultContent: ''},
        {data: 'marca.marca', name:'marca.marca', defaultContent: ''},
        {data: 'n_activo', defaultContent: ''},
        {data: 'n_serial', defaultContent: ''},
        { data: 'action', name: 'acciones', orderable: false, searchable: false },
    ],
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