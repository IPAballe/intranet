{{-- comentario --}}
<div class="flex flex-col">
    <div class="-my-6 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

            <div class="bg-white px-2 py-0 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class=" text-gray-500">
                    <select wire:model="perPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="float-right">
                    <button wire:click.prevent="createModal()" class="btn btn-primary mt-2 mb-2" data-toggle="modal" data-target="#modal">
                        Nueva
                    </button>
                </div>
            </div>

            <table class="table-fixed min-w-full divide-y divide-gray-200 mt-1">
                <thead class="bg-cool-gray-50">
                <tr>
                   <th  scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Metrocontador
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ano/Mes
                    </th>
                    <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Plan
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        UM
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($planes as $value )
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-3 py-1 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $value->metro->metro_desc }}</div>
                            </td>

                            <td class="px-3 py-1 text-center whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $value->ano . ' / ' . $value->mes }}</div>
                            </td>

                            <td class="px-3 py-1 whitespace-nowrap ">
                                <div class="text-sm text-gray-900 float-right">{{ $value->plan}}
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

                            <td class="px-3 py-1 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $value->metro->tipo->tipos_desc }}</div>
                            </td>

                            <td class="px-3 py-1 whitespace-nowrap text-sm font-medium">
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
                {{ $planes->links()}}
            </div>
        </div>
      </div>
    </div>

{{-- Se forma la MODAL reutilizable para editar o crear --}}
    @include('comun.modal_head')
    @if ($selected_id > 0)
        @include('energia.plan_update')
    @else
        @include('energia.plan_create')
    @endif
    @include('comun.modal_footer')


