<?php

namespace App\Http\Livewire;

use App\Models\Lecturas;
use App\Models\Metros;
use App\Models\Tipos;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class LiveLecturas extends Component
{
    use WithPagination;


    public $perPage = 5;
    public $search = '';

    public $componentName = 'Lecturas', $selected_id;

    public $lectura, $fecha, $cambiometro = false;
    public $metro_id=0, $tipoSeleccionado='', $tipos_id, $ultimaLectura;

    public $updateMode = true;

    public function mount()
    {
        // $this->fecha = Carbon::now()->format('Y-m-d');
        $this->tipoSeleccionado = (Tipos::orderBy('id', 'asc'))->first()->id;
        $t = (Metros::orderBy('metro_desc', 'asc')
                    ->where('activo', '1')
                    ->where('tipo_id',$this->tipoSeleccionado))->first();
        if (!is_null($t))  $this->metro_id = $t->id;
    }

    public function render()
    {
        $tipos = Tipos::orderBy('id', 'asc')
                      ->get();

        $metros = Metros::where('tipo_id', $this->tipoSeleccionado)
                        ->where('activo','1')
                        ->orderBy('metro_desc', 'asc')
                        ->get();
        if ($this->page > 1)
            $lecturas = Lecturas::where('metro_id', $this->metro_id)
                                ->where('lectura', 'like', "%$this->search%")
                                ->paginate($this->perPage);
        else
            $lecturas = Lecturas::where('metro_id', $this->metro_id)
                                ->where('lectura', 'like', "%$this->search%")
                                ->orderBy('fecha','desc')
                                ->paginate($this->perPage);

        $l = Lecturas::where('metro_id', $this->metro_id)
                     ->orderBy('fecha', 'desc')
                     ->first();
        $this->fecha = Carbon::parse(substr($l->fecha, 0, 11))->addDay()->format('Y-m-d');
        $this->ultimaLectura = $l->lectura;

        return view('livewire.live-lecturas', [
                    'lecturas'=>$lecturas,
                    'tipos' => $tipos,
                    'metros' => $metros,
                ]);
    }

    public function updatedtipoSeleccionado($value)
    {
        $this->metros = Metros::where('tipo_id', $value)
                              ->where('activo','1')
                              ->orderBy('metro_desc', 'asc')
                              ->get();
        if (!is_null($this->metros->first()))
            $this->metro_id = $this->metros->first()->id;
        else $this->metro_id =0;
        $this->tipos_id = $value;
    }

    public function resetInputFields()
    {
        $this->lectura = '';
        $this->cambiometro = false;
        $this->fecha = Carbon::now();
    }

    public function edit($id)
    {
        $record = Lecturas::findOrFail($id);

        $this->selected_id  = $id;
        $this->lectura      = $record->lectura;
        $this->cambiometro  = $record->cambiometro;

        $this->fecha        = Carbon::parse(substr($record->fecha, 0, 11))->format('Y-m-d');
        $this->metro_id     = $record->metro_id;

        $this->updateMode = true;
    }

    public function lecturaSiguiente($metro_id)
    {
        $record = Lecturas::where('metro_id',$metro_id)
                            ->where('fecha','>',$this->fecha)
                            ->orderBy('fecha', 'asc')
                            ->first();

        if (is_null($record)) return 9999999999999;

        return $record->lectura;
    }

    public function lecturaAnterior($metro_id)
    {
        $record = Lecturas::where('metro_id',$metro_id)
                      ->where('fecha','<',$this->fecha)
                      ->orderBy('fecha', 'desc')
                      ->first();
        if (is_null($record)) return 0;

        return $record->lectura;
    }

    public function update()
    {
        $lA = $this->lecturaAnterior ($this->metro_id);
        $lS = $this->lecturaSiguiente($this->metro_id);

        $this->validate([
               'lectura'   => "required | integer | min:$lA | max:$lS",
               ]);

        if($this->selected_id)
        {
            $record = Lecturas::find($this->selected_id);
            $record->update([
                     'lectura' => $this->lectura,
                     ]);
        }
        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function store()
    {
        $this->selected_id = null;

        $lA = $this->lecturaAnterior ($this->metro_id);
        $lS = $this->lecturaSiguiente($this->metro_id);
        $this->validate([
            'lectura'   => "required | integer | min:$lA | max:$lS",
            'fecha'     => 'required',
        ]);

        Lecturas::create([
            'lectura'     => $this->lectura,
            'fecha'       => Carbon::parse($this->fecha),
            'cambiometro' => $this->cambiometro,
            'metro_id'    => $this->metro_id,
        ]);

        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function delete($id)
    {
        if ($id) {
            $record = Lecturas::where('id', $id);
            $record->delete();
        }
    }

    public function clear()
    {
        $this->page = 1;
        $this->perPage = 5;
        $this->resetPage();
        $this->resetErrorBag();
        $this->selected_id = null;
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->resetErrorBag();
    }

    public function createModal()
    {
        $this->selected_id = null;
    }
}
