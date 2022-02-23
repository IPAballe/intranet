{{-- comentario --}}
<div class="flex flex-col">
    <div class="-my-6 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="bg-white px-2 py-0 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex text-gray-500">
                        <select wire:model="perPage">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="float-right">
                        <button wire:click.prevent="createModal()" class="btn btn-primary mt-2 mb-2" data-toggle="modal"
                            data-target="#modal">
                            Nuevo
                        </button>
                    </div>
                </div>

                <table class="table-fixed min-w-full divide-y divide-gray-200 mt-1">
                    <thead class="bg-cool-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Entidad
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Metrocontador
                                <button wire:click="sortable('metro_desc')">
                                    <span class="fa fa{{ $campo === 'metro_desc' ? $icono : '-circle' }}""> </span>
                        </button>
                    </th>
                    <th scope=" col"
                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($metros as $value)
                            <tr
                                class="hover:bg-gray-300 dark:hover:bg-gray-700  {{ $value->activo ? 'text-gray-900' : 'text-gray-300 hover:text-white' }}">
                                <td class="px-3 py-1 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $value->entidad->entidad_desc }}</div>
                                </td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    <div class="whitespace-nowrap ">
                                        @include('comun.logo_tipo_metro',['tipo_id'=>$value->tipo_id])
                                        {{ $value->metro_desc }}
                                    </div>
                                </td>

                                <td class="px-3 py-1 whitespace-nowrap text-sm font-medium">
                                    <button data-toggle="modal" data-target="#modal"
                                        wire:click="edit({{ $value->id }})" class="btn btn-primary btn-sm">Editar
                                    </button>
                                    @if ($value->activo)
                                        <button wire:click="desactivar({{ $value->id }})"
                                            class="btn btn-danger btn-sm">Desactivar
                                        </button>
                                    @else
                                        <button wire:click="activar({{ $value->id }})"
                                            class="btn btn-info btn-sm">Activar
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    {{ $metros->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Se forma la MODAL reutilizable para editar o crear --}}
    @include('comun.modal_head')
    @if ($selected_id > 0)
        @include('energia.metro_update')
    @else
        @include('energia.metro_create')
    @endif
    @include('comun.modal_footer')
</div>
