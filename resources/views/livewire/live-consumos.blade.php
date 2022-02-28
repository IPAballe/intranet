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
                                UM
                            </th>
                            <th class="px-6 py-2 text-right text-xs font-medium text-gray-500 uppercase">
                                Plan
                            </th>
                            <th class="px-6 py-2 text-right text-xs font-medium text-gray-500 uppercase">
                                %
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($Consumos as $key => $value)
                        @if (!is_null($value))
                            <tr class="hover:bg-gray-300 dark:hover:bg-gray-700">
                                <td class="px-6 py-0 text-center text-lg">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::createfromFormat('Y-m-d', $key)->format('d-m-Y')}}
                                    </div>
                                </td>
                                <td class="px-6 py-0 text-right text-base font-bold">
                                    <div class="whitespace-nowrap ">
                                        {{number_format($value, 2)}}
                                    </div>
                                </td>

                                <td class="px-6 py-0 text-right text-xs font-medium">
                                    {{ $um}}
                                </td>

                                <td class="px-6 py-0 text-right text-xs font-medium">
                                    @if (!is_null($planes))
                                        {{number_format($planes->plan / $ddm, 2)}}
                                    @endif
                                </td>

                                <td class="px-6 py-0 text-right text-xs font-medium">
                                    @if (!is_null($planes))
                                        {{number_format(($value /($planes->plan / $ddm))*100, 2)}}
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
