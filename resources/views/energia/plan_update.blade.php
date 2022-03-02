{{-- Body de la Modal para EDITAR NUEVA --}}

<div class="modal-body">
    <form>
        <div class="container">
                <div class="form-group col-6">
                    <label>Plan:</label>
                    <input type="text"
                           class="form-control"
                           placeholder="Plan"
                           wire:model="plan"
                    >
                    @error('lectura') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
        </div>
    </form>
</div>



