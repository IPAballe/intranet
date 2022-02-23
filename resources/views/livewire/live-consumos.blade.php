<div class="container-fluid">
    <div class="row">
        <div class="flex col-12">
            <label class="mt-1">Metrocontador</label>

                <select wire:model="metro_id" class="form-control ml-3">
                    <option value="0">Total</option>
                    @foreach ( $metros as $value)
                        <option value="{{ $value->id}}">{{ $value->metro_desc }}</option>
                    @endforeach
                </select>

        </div>
    </div>
</div>
