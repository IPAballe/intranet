@extends('adminlte::page')

@section('title','Lecturas')

@section('content_header')
    <h1> Lecturas de los Metrocontadores</h1>
@stop

@section('css')
    <link href="{{ asset('vendor/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/DataTables/Bootstrap-4-4.6.0/css/bootstrap.min.css') }}" rel="stylesheet">
@endsection


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                boton
            </div>
            <div class="col-10">
                formulario
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="lecturas" class="table table-striped table-bordered table-hover" >

                    <thead class="table-info">
                        <tr>
                            <th>Fecha</th>
                            <th>Lectura</th>
                            <th>Metro_id</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lecturas as $lectura )
                            <tr>
                                <td>{{$lectura->fecha;}}</td>
                                <td>{{$lectura->lectura;}}</td>
                                <td>{{$lectura->metro_id;}}</td>
                                <td class="border px-4 py-2">
                                    <button wire:click="edit({{ $lectura->id; }})"
                                        class="btn">Editar
                                    </button>
                                    <button wire:click="destroy({{ $lectura->id; }})"
                                        class="btn">Borrar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>
    <script>
        $('#lecturas').DataTable({
            "order": [2, 'asc'],
            "language": {
                url: "https://cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json"
            },

            "dom":  "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'f><'col-sm-12 col-md-4'B>>"+
                    "<'row'<'col-sm-12't>>" +
                    "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",

            buttons: ['excel', 'pdf', 'print'],

            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            "iDisplayLength": 10,
            "pagingType": "simple",
        });
    </script>

@endsection
