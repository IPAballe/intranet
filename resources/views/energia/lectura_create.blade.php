<div class="modal-body">
    <form>
        <div class="container">
            <div class="row">
                <label class="mt-1">Tipo</label>
                <div class="col-sm">
                    <select wire:model="tipoSeleccionado" class="form-control">
                        @foreach ($tipos as $value)
                            <option value="{{ $value->id}}">{{ $value->tipos_desc }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="mt-1">Metro</label>
                <div class="form-group col-sm">
                    <select wire:model="metro_id" class="form-control">
                        @foreach ( $metros as $value)
                            <option value="{{ $value->id}}">{{ $value->metro_desc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="div form-group col-6">
                    <input wire:model="fecha" class="date form-control" id="fecha" type="date" value="$fecha">
                    @error('fecha') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group col-6">
                    <input  wire:model="lectura"
                            wire:keydown.enter="pasaFocoBoton"
                            class="form-control" type="text" id="lectura"
                            placeholder="Entre lectura > [{{$ultimaLecturaMostrar}}]">
                    @error('lectura') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="form-check text-right">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" wire:model="cambiometro">
            <label class="form-check-label " for="flexCheckDefault">
              Cambio de Metro
            </label>
          </div>
    </form>
</div>

<script>
    window.onload = function() {
        document.getElementById("input1").focus();
    }
</script>



