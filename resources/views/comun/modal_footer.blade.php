            <div class="modal-footer">
                <button  wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>

                @if ($selected_id < 1)  <!-- CREAR  -->
                    <button  wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
                @else                   <!-- EDITAR  -->
                    <button  wire:click.prevent="update()" class="btn btn-primary close-modal" data-dismiss="modal">Actualizar</button>
                @endif


            </div>
        </div>
    </div>
</div>
