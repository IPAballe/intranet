
<div class="flex flex-col">
    <div class="-my-6 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="bg-white px-2 py-0 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-xs">
                                <select wire:model="perPage"  class="form-control">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="365">365</option>
                                </select>
                            </div>

                            <div class="col-xs ml-2">
                                <select wire:model="tipoSeleccionado" class="form-control">
                                    @foreach ($tipos as $value)
                                        <option value="{{ $value->id}}">{{ $value->tipos_desc }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-xs ml-2">
                                <select wire:model="metro_id" class="form-control">
                                    @foreach ( $metros as $value)
                                        <option value="{{ $value->id}}">{{ $value->metro_desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-xs ml-2">
                                <input type="text" class="form-control"
                                       wire:model="search"
                                       placeholder="Lectura a buscar"

                                >
                            </div>
                            <div class="col-xs">
                                <button wire:click.prevent="createModal()" class="btn btn-primary mb-2 ml-2" data-toggle="modal"
                                    data-target="#modal">
                                    Nuevo
                                </button>
                            </div>
                        </div>
                    </div>


                </div>

            <table class="table-fixed table-light min-w-full divide-y divide-gray-200 mt-1">

            <thead class="thead-light">
                <tr>
                   <th
                        scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Metrocontador
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha
                    </th>
                    <th scope="col" class="float-right px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Lectura
                    </th>
                    <th scope="col" class="px-10 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if (!is_null($lecturas))
                    @foreach ($lecturas as $value )
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-3 py-1 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $value->metro->metro_desc }}</div>
                            </td>

                            <td class="px-3 py-1 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse(substr($value->fecha, 0, 11))->format('d/m/Y') }}</div>
                            </td>

                            <td class="px-3 py-1 whitespace-nowrap ">
                                <div class="text-sm text-gray-900 float-right">
                                     {{ $value->lectura}}
                                     @include('comun.logo_tipo_metro',['tipo_id' => $value->metro->tipo_id])
                                </div>
                            </td>

                            <td class="px-3 py-1 whitespace-nowrap text-left text-sm font-medium">
                                <button data-toggle="modal" data-target="#modal"
                                        wire:click="edit({{ $value->id }})"
                                        class="btn btn-primary btn-sm">Editar
                                </button>
                                <button
                                        wire:click="delete({{ $value->id }})"
                                        class="btn btn-danger btn-sm">Borrar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                {{ $lecturas->links()}}
            </div>
        </div>
    </div>

    @include('comun.modal_head')
    @if ($selected_id > 1)
        @include('energia.lectura_update')
    @else
        @include('energia.lectura_create')
    @endif
    @include('comun.modal_footer')

</div>
