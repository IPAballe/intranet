{{-- Body de la Modal para EDITAR EXISTENTE --}}

<div class="modal-body">
    <form>
        <div class="container">
            <div class="row">
                <div class="form-group col-10">
                    <input type="text" class="form-control" placeholder="Descripcion de la Entidad"
                           wire:model="entidad_desc">
                    @error('entidad_desc') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-check text-right col-2 mt-2">
                    <input class="form-check-input" type="checkbox" value="" id="CheckActivo"
                           wire:model="activo">
                    <label class="form-check-label " for="CheckActivo">Activo</label>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-8">
                    <input type="text" class="form-control" placeholder="correo electronico"
                           wire:model="correo">
                    @error('correo') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group col-4">
                    <input type="text" class="form-control" placeholder="telefono"
                           wire:model="telefono">
                    @error('telefono') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </form>
</div>







