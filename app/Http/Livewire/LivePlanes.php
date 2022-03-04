<?php

namespace App\Http\Livewire;

use App\Models\Planes;
use App\Models\Metros;
use App\Models\Tipos;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class LivePlanes extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $componentName = 'Planes', $selected_id=null;
    public $plan, $ano, $mes, $ano_mes;
    public $metro_id, $tipoSeleccionado, $tipos_id;


    public function mount()
    {
        $this->tipos_id = ((Tipos::orderBy('tipos_desc', 'asc'))->first())->id;
        $t = (Metros::orderBy('metro_desc', 'asc')->where('activo', '1')->where('tipo_id',$this->tipos_id))->first();
        if (!is_null($t))  $this->metro_id = $t->id;
    }

    public function render()
    {
        $planes = Planes::where('id','<>','0')
                        ->paginate($this->perPage);

        $tipos = Tipos::orderBy('tipos_desc', 'asc')
                      ->get();

        $metros = Metros::where('tipo_id', $tipos->first()->id)
                        ->where('activo','1')
                        ->orderBy('metro_desc', 'asc')
                        ->get();

        return view('livewire.live-planes', [
                    'planes'=>$planes,
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
        $this->plan = '';
        $this->selected_id = null;
    }

    public function edit($id)
    {
        $record = Planes::findOrFail($id);

        $this->selected_id  = $id;

        $this->plan         = $record->plan;
        $this->ano          = $record->ano;
        $this->mes          = $record->mes;
        $this->ano_mes      = Carbon::parse($record->ano.'-'.$record->mes);
        $this->metro_id     = $record->metro_id;
    }

    public function update()
    {
         $this->validate([
               'plan'   => "required | integer | min:0",
               ]);

        if($this->selected_id)
        {
            $record = Planes::find($this->selected_id);
            $record->update([
                     'plan' => $this->plan,
                     ]);
        }

        $this->resetInputFields();
    }

    public function store()
    {
        $this->selected_id = null;

        $this->validate([
            'plan' => "required | integer | min:0",
           // 'ano'  => 'required | unique:Planes,ano,mes,metro_id',
        ]);

        Planes::create([
                'plan'     => $this->plan,
                'ano'      => Carbon::parse($this->ano_mes)->format('Y'),
                'mes'      => Carbon::parse($this->ano_mes)->format('m'),
                'metro_id' => $this->metro_id,
            ]);

        $this->resetInputFields();
    }

    public function delete($id)
    {
        if ($id) {
            $record = Planes::where('id', $id);
            $record->delete();
        }
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
