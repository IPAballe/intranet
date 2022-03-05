@extends('adminlte::page')

@section('title','Trabajadores')

@section('content_header')
    <h1> Listado General de Trabajadores</h1>
@stop

$@section('ccs')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">

@endsection


@section('content')

            <table id="listadogeneral" class="table table-striped table-bordered table-hover" >

                <thead class="table-info">
                    <tr>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Apellido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listadoGeneral as $trabajador )
                        <tr>
                            <td>{{$trabajador->no_expediente;}}</td>
                            <td>{{$trabajador->nombre;}}</td>
                            <td>{{$trabajador->apell1;}}</td>
                            <td>{{$trabajador->apell2;}}</td>
                        </tr>
                    @endforeach
                    <tfoot class="table-info">
                        <tr>
                            <th>CI</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Apellido</th>
                        </tr>
                    </tfoot>
                </tbody>
            </table>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.4/filtering/type-based/accent-neutralise.js"></script>
    <script src="public/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script>
        $('#listadogeneral').DataTable({
            "order": [2, 'asc'],
            "language": {
                url: "https://cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json"
            },

            "dom":  "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-3'f><'col-sm-12 col-md-3'Bp>>"+
                    "<'row'<'col-sm-12't>>" +
                    "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",

            buttons: ['excel', 'pdf', 'print'],

            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "Todos"]],
            "iDisplayLength": 5,
            "pagingType": "simple",
        });
    </script>

@endsection
