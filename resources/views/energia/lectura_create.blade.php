<!-- Modal CREAR NUEVA-->
           <div class="modal-body">
                <form>
                    <div class="container">
                        <div class="row">
                            <label>Tipo</label>
                            <div class="form-group col-sm">
                                <select wire:model="tipoSeleccionado">
                                    @foreach ($tipos as $value)
                                        <option value="{{ $value->id}}">{{ $value->tipos_desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label>Metro</label>
                            <div class="form-group col-sm">
                                <select wire:model="metro_id">
                                    @foreach ( $metros as $value)
                                        <option value="{{ $value->id}}">{{ $value->metro_desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                   <!--
                    <label> {{ 'Metro_id='.$metro_id . ' tipos_id='.$tipos_id}}</label>
                   -->
                    <div class="container">
                        <div class="row">
                            <div class="div form-group col-6">
                                <input wire:model="fecha" class="date form-control" id="fecha" type="date" value="$fecha">
                                @error('fecha') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-6">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Entre lectura" wire:model="lectura">
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



