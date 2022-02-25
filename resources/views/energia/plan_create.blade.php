{{-- Body de la Modal para INSERTAR NUEVA --}}

<div class="modal-body">
    <form>
        <div class="container">
            <div class="row">
                <div class="form-group col-3">
                    <label>Tipo</label>
                    <select wire:model="tipoSeleccionado" class="form-control">
                        @foreach ($tipos as $value)
                            <option value="{{ $value->id}}">{{ $value->tipos_desc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-9">
                    <label>Metro</label>
                    <select wire:model="metro_id" class="form-control">
                        @foreach ( $metros as $value)
                            <option value="{{ $value->id}}">{{ $value->metro_desc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <label>{{ "Ano/Mes=$ano_mes | Plan=$plan | id_tipo=$tipos_id | metro_id=$metro_id"}}</label>



        <div class="container">
            <div class="row">
                <div class="div form-group col-6">
                    <input type="month"
                           class="date form-control"
                           wire:model="ano_mes"
                    >
                    @error('ano_mes') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group col-6">
                    <input type="text"
                           class="form-control"
                           placeholder="Plan"
                           wire:model="plan"
                    >
                    @error('plan') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </form>
</div>



