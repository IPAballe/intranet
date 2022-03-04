@extends('adminlte::page')

@section('title','Trabajadores')

@section('content_header')
    <h1> Listado General de Trabajadores</h1>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
@endsection


@section('content')
            @include('ficha')
            <table id="listadogeneral" class="table table-striped table-bordered table-hover table-sm mt-1 shadow-lg" >

                <thead class="table-info bg-primary">
                    <tr>
                        <th>Ficha</th>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Area</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trabajadores as $trabajador )
                        <tr>
                            <td>
                                <div class="text-center">
                                    <button  type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#ficha">
                                        Ficha
                                    </button>
                                </div>
                            </td>
                            <td>{{$trabajador->no_expediente;}}</td>
                            <td>{{$trabajador->nombre;}}</td>
                            <td>{{$trabajador->apell1.' '.$trabajador->apell2;}}</td>
                            <td>{{$trabajador->UO;}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.4/filtering/type-based/accent-neutralise.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>


    <script>
        $(document).ready(function(){

            var table = $('#listadogeneral').DataTable({
            "responsive": true,
            "autowidth": false,
            "order": [2, 'asc'],
            "language": {url: "https://cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json"},

            "dom":  "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'f><'row justify-content-end col-sm-12 col-md-4'B>>"+
                    "<'row'<'col-sm-12't>>" +
                    "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
            'lengthChange': true,

            buttons: [{
                        extend:         'excelHtml5',
                        exportOptions:  {columns: [1,2,3,4]}
                    },
                    'pdfHtml5',
                    'print',
                    'colvis'
                ],



            "lengthMenu": [[9, 25, 50, -1], [9, 25, 50, "Todos"]],
            "iDisplayLength": 9,
            "pagingType": "simple",
            });

        table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );

        });


    </script>

@endsection
