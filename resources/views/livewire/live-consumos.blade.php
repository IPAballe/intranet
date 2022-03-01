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
                <div class="table-responsive">
                <table class="table table-sm mt-2">
                    <thead class="thead-light ">
                        <tr>
                            <th class="px-6 py-2 text-center text-xs font-medium uppercase">
                                Dia
                            </th>
                            <th class="px-6 py-2 text-right text-xs font-medium uppercase ">
                                Consumo
                            </th>
                            <th class="px-6 py-2 text-right text-xs font-medium uppercase">
                                UM
                            </th>
                            <th class="px-6 py-2 text-right text-xs font-medium uppercase">
                                Plan
                            </th>
                            <th class="px-6 py-2 text-right text-xs font-medium uppercase">
                                %
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $v= '';  $planTotal = 0; $consumoTotal = 0;?>
                        @foreach ($Consumos as $key => $value)
                            @if (!is_null($value))
                                 @if (!is_null($planes))
                                    @if ($value > $planes->plan / $ddm)
                                        <?php $v = 'text-red-600 bg-gray-100';?>
                                    @else <?php $v= '';?>
                                    @endif
                                <?php
                                    $planTotal    = $planTotal + ($planes->plan / $ddm);
                                ?>
                            @endif
                            <?php
                                $consumoTotal = $consumoTotal +$value;
                            ?>
                            <tr class="hover:bg-gray-300 dark:hover:bg-gray-700 {{$v}}">
                                <td class="px-6 py-2 text-center text-base  font-medium">
                                    {{ \Carbon\Carbon::createfromFormat('Y-m-d', $key)->format('d-m-Y')}}
                                </td>
                                <td class="px-6 py-2 text-right text-base font-bold">
                                    {{number_format($value, 2)}}
                                </td>

                                <td class="px-6 py-2 text-right text-base  font-medium">
                                    {{ $um}}
                                </td>

                                <td class="px-6 py-2 text-right  text-base  font-medium">
                                    @if (!is_null($planes))
                                        {{number_format($planes->plan / $ddm, 2)}}
                                    @endif
                                </td>

                                <td class="px-6 py-2 text-right  text-base font-medium">
                                    @if (!is_null($planes))
                                        {{number_format(($value /($planes->plan / $ddm))*100, 2)}}
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="px-6 py-2 text-center text-base  font-medium">
                                Total
                            </td>
                            <td class="px-6 py-2 text-right text-base  font-medium">
                                {{ number_format($consumoTotal, 2)}}
                            </td>
                            <td class="px-6 py-2 text-right text-base  font-medium">
                                {{ $um}}
                            </td>
                            <td class="px-6 py-2 text-right text-base  font-medium">
                                {{ number_format($planTotal, 2)}}
                            </td>
                            <td class="px-6 py-2 text-right text-base  font-medium">
                                @if ($planTotal > 0)
                                    {{ number_format(($consumoTotal / $planTotal)*100, 2)}}
                                @endif
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </div>

            </div>
        </div>
    </div>
</div>
