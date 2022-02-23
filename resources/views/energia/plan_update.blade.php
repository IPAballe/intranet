{{-- Body de la Modal para EDITAR NUEVA --}}

<div class="modal-body">
    <form>
        <label>{{ "Ano/Mes=$ano_mes | Plan=$plan | id_tipo=$tipos_id | metro_id=$metro_id | selected_id=$selected_id"}}</label>

        <div class="container">
                <div class="form-group col-6">
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



