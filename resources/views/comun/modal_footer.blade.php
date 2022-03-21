            <div class="modal-footer">
                <button  wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>

                @if ($selected_id < 1)
                    <button  wire:click.prevent="store()" class="btn btn-primary close-modal" id="guardar">Guardar</button>
                @else
                    <button  wire:click.prevent="update()" class="btn btn-primary close-modal" data-dismiss="modal">Actualizar</button>
                @endif


            </div>
        </div>
    </div>
</div>
