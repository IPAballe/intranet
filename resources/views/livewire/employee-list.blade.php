


<div class="row">
    <div class="col-sm-9">
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

                            <button class = "btn btn-success btn-sm" data-toggle="modal" data-target="#ficha" onclick="">
                                Ficha
                            </button>

                        </td>
                        <td>{{ $trabajador->no_expediente; }}</td>
                        <td>{{ $trabajador->nombre; }}</td>
                        <td>{{ $trabajador->apell1.' '.$trabajador->apell2; }}</td>
                        <td>{{ $trabajador->UO; }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
