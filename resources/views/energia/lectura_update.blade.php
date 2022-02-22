<!-- Modal para EDITAR Lectura -->

            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Lectura</label>
                        <input type="text" required pattern="[0-9]" class="form-control" wire:model="lectura" >
                        @error('lectura') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>

