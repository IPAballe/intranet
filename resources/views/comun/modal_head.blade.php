<div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <b>
                        {{$componentName}} | {{$selected_id > 0 ? 'EDITAR' : 'CREAR'}}
                    </b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">&times;</span>
                </button>
                <h6 class="text-center text-warning" wire:loading>Por favor espere....</h6>
            </div>
