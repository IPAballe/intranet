

<div class="flex flex-col">
    <div class="-my-6 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

            <div class="bg-white px-4 py-0 items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex text-gray-500">
                    <select wire:model="perPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <input
                        type=           "text"
                        class=          "focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                        wire:model  =   "search"
                        placeholder =   "Escriba termino a buscar..."
                    >

                    <button wire:click="clear">
                        <span class="fa fa-eraser"></span>
                    </button>

                    <button wire:click.prevent="createModal()" class="btn btn-primary ml-4 " data-toggle="modal" data-target="#modal">
                        Nueva
                    </button>
                </div>
            </div>


            <table class="table-fixed min-w-full divide-y divide-gray-200 mt-1">
                <thead class="bg-cool-gray-50">
                <tr>
                   <th
                        scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metrocontador (Punto de Venta)
                        <button wire:click="sortable('metro_id')">
                            <span class="fa fa{{ $campo === 'metro_id' ? $icono : '-circle'}}"> </span>
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha
                        <button wire:click="sortable('fecha')">
                            <span class="fa fa{{ $campo === 'fecha' ? $icono : '-circle'}}""> </span>
                        </button>
                    </th>
                    <th scope="col" class="float-right px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lectura
                        <button wire:click="sortable('lectura')">
                            <span class="fa fa{{ $campo === 'lectura' ? $icono : '-circle'}}""> </span>
                        </button>
                    </th>
                    <th scope="col" class="px-10 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($lecturas as $value )
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-3 py-1 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $value->metro->metro_desc }}</div>
                            </td>

                            <td class="px-3 py-1 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse(substr($value->fecha, 0, 11))->format('d/m/Y') }}</div>
                            </td>

                            <td class="px-3 py-1 whitespace-nowrap ">
                                <div class="text-sm text-gray-900 float-right">{{ $value->lectura}}
                                <span class="
                                    @switch ($value->metro->tipo_id)
                                        @case(1)
                                            fas fa-bolt fa-fw
                                        @break
                                        @case(2)
                                           fas fa-water fa-fw
                                        @break
                                        @case(3)
                                           fas fa-fire fa-fw
                                        @break
                                    @endswitch
                                    "
                                </span>
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
                </tbody>
            </table>
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                {{ $lecturas->links()}}
            </div>
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
