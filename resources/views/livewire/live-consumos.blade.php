{{-- comentario --}}
<div class="flex flex-col">
    <div class="-my-6 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="row bg-white px-2 py-0 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="col-3">
                        <input type="month" class="mt-2 date form-control" value="{{$ano_mes}}"
                               wire:model="ano_mes">
                    </div>
                    <div class="flex col-9">
                        <label class="mt-3">Metrocontador</label>
                            <select wire:model="metro_id" class="form-control mt-2 ml-3">
                                <option value="0">Total</option>
                                @foreach ( $metros as $value)
                                    <option value="{{ $value->id}}">{{ $value->metro_desc }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>
                                {{ "metro_id=$metro_id | ano_mes=$ano_mes ||

                                "}}
                            </label>
                        </div>
                    </div>
                </div>

                <table class="table-fixed min-w-full divide-y divide-gray-200 mt-1">
                    <thead class="bg-cool-gray-50">
                        <tr>
                            <th class="px-6 py-2 text-center text-xs font-medium text-gray-500 uppercase">
                                Dia
                            </th>
                            <th class="px-6 py-2 text-right text-xs font-medium text-gray-500 uppercase ">
                                Consumo
                            </th>
                            <th class="px-6 py-2 text-right text-xs font-medium text-gray-500 uppercase">
                                Plan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($Consumos as $value)
                            <tr class="hover:bg-gray-300 dark:hover:bg-gray-700">
                                <td class="px-3 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{Consumos->fecha}}
                                    </div>
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap">
                                    <div class="whitespace-nowrap ">
                                        {{Consumos->valor}}

                                    </div>
                                </td>

                                <td class="px-3 py-3 whitespace-nowrap text-sm font-medium">


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
