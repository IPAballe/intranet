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

    public $perPage = 10;
    public $campo = 'fecha';
    public $order = 'desc';
    public $icono = '-arrow-circle-down';

    public $componentName = 'Lecturas', $selected_id;

    public $lectura, $fecha, $cambiometro = false;
    public $metro_id=0, $tipoSeleccionado='', $tipos_id;

    public $updateMode = true;

    public function mount()
    {
        $this->icono = $this->iconDirection($this->order);
        $this->fecha = Carbon::now()->format('Y-m-d');
        $this->tipos_id = (Tipos::orderBy('tipos_desc', 'asc'))->first()->id;
        $t = (Metros::orderBy('metro_desc', 'asc')->where('activo', '1')->where('tipo_id',$this->tipos_id))->first();
        if (!is_null($t))  $this->metro_id = $t->id;
    }

    public function render()
    {
        $lecturas = Lecturas::orderBy($this->campo, $this->order)
                            ->paginate($this->perPage);

        $tipos = Tipos::orderBy('tipos_desc', 'asc')
                      ->get();

        $metros = Metros::where('tipo_id', $tipos->first()->id)
                        ->where('activo','1')
                        ->orderBy('metro_desc', 'asc')
                        ->get();

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
        $this->metro_id = $this->metros->first()->id;
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

    public function sortable($campo)
    {
        $this->resetPage();

        if ($campo !== $this->campo)
        {
            $this->order = null;
        }
        switch ($this->order)
        {
            case null:
                $this->order = 'asc';
            break;
            case 'asc':
                $this->order = 'desc';
            break;
            case 'desc':
                $this->order = null;
            break;
        }
        $this->icono = $this->iconDirection($this->order);
        $this->campo = $campo;
    }

    public function iconDirection($direccion) : string
    {
        if (!$direccion)
        {
            return '-circle';
        }

        return $direccion === 'asc' ? '-arrow-circle-up' : '-arrow-circle-down';
    }

    public function clear()
    {
        $this->order = 'desc';
        $this->campo = 'fecha';
        $this->icono = '-arrow-circle-down';
        $this->page = 1;
        $this->perPage = 10;
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
