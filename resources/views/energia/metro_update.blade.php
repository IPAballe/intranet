{{-- Body de la Modal para EDITAR EXISTENTE --}}

<div class="modal-body">
    <form>
        <div class="container">
            <div class="row">
                <div class="form-group col-8">
                    <input type="text" class="form-control" placeholder="Descripcion del Metrocontador"
                           wire:model="metro_desc">
                    @error('metro_desc') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-check text-right col-2 mt-2">
                    <input class="form-check-input" type="checkbox" value="" id="CheckTotaliza"
                           wire:model="totaliza">
                    <label class="form-check-label " for="CheckTotaliza">Totaliza</label>
                </div>
                <div class="form-check text-right col-2 mt-2">
                    <input class="form-check-input" type="checkbox" value="" id="CheckActivo"
                           wire:model="activo">
                    <label class="form-check-label " for="CheckActivo">Activo</label>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-3">
                    <input type="text" class="form-control" placeholder="fact/conv"
                           wire:model="fc">
                    @error('fc') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group col-3">
                    <input type="text" class="form-control" placeholder="Cto_Gto-1"
                           wire:model="cto_gto1">
                    @error('cto_gto1') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group col-3">
                    <input type="text" class="form-control" placeholder="Cto_Gto-2"
                           wire:model="cto_gto2">
                    @error('cto_gto2') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group col-3">
                    <input type="text" class="form-control" placeholder="Cto_Gto-3"
                           wire:model="cto_gto3">
                    @error('cto_gto3') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row">
                <label class="text-sm">
                    {{ "tipo_id=$tipo_id | entidad_id=$entidad_id | metro_desc=$metro_desc | totaliza=$totaliza | Activo=$activo | fc=$fc | cto_gto1=$cto_gto1 | cto_gto2=$cto_gto2 | cto_gto3=$cto_gto3"}}
                </label>
            </div>
        </div>
    </form>
</div>







