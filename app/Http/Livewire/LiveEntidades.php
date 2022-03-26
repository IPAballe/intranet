<?php

namespace App\Http\Livewire;

use App\Models\Entidades;
use App\Models\Provincias;
use App\Models\Municipios;
use Livewire\Component;
use Livewire\WithPagination;

class LiveEntidades extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $campo = 'fecha';
    public $order = 'desc';
    public $icono = '-arrow-circle-down';

    public $componentName = 'Entidades', $selected_id, $provSeleccionada;


    public function mount()
    {
        $this->prov_id  = (Provincias::get())->first()->id;
        $this->munic_id = (Municipios::where('prov_id',$this->prov_id)->first())->id;
    }

    public function render()
    {
        $entidades = Entidades::orderBy('entidad_desc', 'asc')
                            ->paginate($this->perPage);
        $provincias = Provincias::all();
        $municipios = Municipios::all();

        return view('livewire.live-entidades', [
            'entidades'  => $entidades,
            'provincias' => $provincias,
            'municipios' => $municipios,
        ]);
    }

    public function updatedProvSeleccionada($value)
    {
        $this->municipios = Municipios::where('prov_id', $value)->get();
        $this->munic_id = $this->municipios->first()->id;
        $this->prov_id = $value;
    }

    public function edit($id)
    {
        $record = Entidades::findOrFail($id);

        $this->selected_id   = $id;
        $this->entidad_desc  = $record->entidad_desc;
        $this->telefono      = $record->telefono;
        $this->correo        = $record->correo;
        $this->activo        = $record->activo;
        $this->munic_id      = $record->munic_id;
    }

    public function update()
    {
         $this->validate([
               'entidad_desc' => "required",
               'telefono'     => "required | numeric",
               'correo'       => "required | email",
               ]);

        if($this->selected_id)
        {
            $record = Entidades::find($this->selected_id);
            $record->update([
                     'entidad_desc' => $this->entidad_desc,
                     'telefono'     => $this->telefono,
                     'correo'       => $this->correo,
                     'activo'       => $this->activo ? 1 : 0,
                     ]);
        }
        $this->resetInputFields();
    }

    public function store()
    {
        $this->selected_id = null;

        $this->validate([
            'entidad_desc' => "required",
            'telefono'     => "required | numeric",
            'correo'       => "required | email",
                ]);

        Entidades::create([
                'munic_id'    => $this->munic_id,
                'entidad_desc'=> $this->entidad_desc,
                'telefono'    => $this->telefono,
                'activo'      => $this->activo ? 1 : 0,
                'correo'      => $this->correo,
            ]);

        $this->resetInputFields();
    }

    public function activar($id)
    {
        if ($id)
        {
            $record = Entidades::find($id);
            $record->update([ 'activo' => 1 ]);
        }
    }

    public function desactivar($id)
    {
        if ($id)
        {
            $record = Entidades::find($id);
            $record->update([ 'activo' => 0 ]);
        }
    }

    public function resetInputFields()
    {
        $this->entidad_desc = '';
        $this->telefono     = '';
        $this->correo       = '';
        $this->activo       = 1;

        $this->selected_id  = null;
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
