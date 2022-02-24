<?php

namespace App\Http\Livewire;

use App\Models\Entidades;
use App\Models\Metros;
use App\Models\Tipos;
use Livewire\Component;
use Livewire\WithPagination;

class LiveMetros extends Component
{
    use WithPagination;

    public $search  = '';
    public $perPage = 10;
    public $campo   = null;
    public $order   = null;
    public $icono   = '-circle';

    public $componentName = 'Metros', $selected_id = null;

    public $metro_desc, $fc, $totaliza, $activo,
           $cto_gto1, $cto_gto2, $cto_gto3,
           $entidad_id, $tipo_id;

    protected $queryString = [
        'search' => ['except'=>''],
        'perPage' => ['except'=>10],
        'campo' => ['except'=>null],
        'order' => ['except'=>null],
    ];

    public function mount()
    {
        $this->icono      = $this->iconDirection($this->order);
        $this->tipo_id    = (Tipos::orderBy('tipos_desc', 'asc'))->first()->id;
        $this->entidad_id = (Entidades::orderBy('entidad_desc', 'asc'))->first()->id;
    }

    public function render()
    {
        $metros = Metros::where('metro_desc','like',"%{$this->search}%");

        if ( $this->campo && $this->order )
        {
            $metros = $metros->orderBy($this->campo, $this->order);
        }
        $metros = $metros->paginate($this->perPage);

        $tipos = Tipos::orderBy('tipos_desc', 'asc')
                      ->get();
        $entidades = Entidades::orderBy('entidad_desc', 'asc')
                              ->get();

        return view('livewire.live-metros', [
                                             'metros'=> $metros,
                                             'tipos' => $tipos,
                                             'entidades' => $entidades,
                                            ]);
    }


    public function sortable($campo)
    {
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function clear()
    {
        $this->search = '';
        $this->order = null;
        $this->campo = null;
        $this->order = null;
        $this->icono = '-circle';
        $this->page = 1;
        $this->perPage = 10;
    }

    public function resetInputFields()
    {
        $this->metro_desc   = '';
        $this->fc           = 1;
        $this->totaliza     = 1;
        $this->activo       = 1;
        $this->cto_gto1     = '';
        $this->cto_gto2     = '';
        $this->cto_gto3     = '';
        $this->selected_id  = null;
    }

    public function edit($id)
    {
        $record = Metros::findOrFail($id);

        $this->selected_id = $id;
        $this->metro_desc  = $record->metro_desc;
        $this->fc          = $record->fc;
        $this->totaliza    = $record->totaliza;
        $this->activo      = $record->activo;
        $this->cto_gto1    = $record->cto_gto1;
        $this->cto_gto2    = $record->cto_gto2;
        $this->cto_gto3    = $record->cto_gto3;
        $this->entidad_id  = $record->entidad_id;
    }

    public function update()
    {
         $this->validate([
               'metro_desc' => "required",
               'fc'         => "required | numeric",
               ]);

        if($this->selected_id)
        {
            $record = Metros::find($this->selected_id);
            $record->update([
                     'metro_desc' => $this->metro_desc,
                     'fc'         => $this->fc,
                     'totaliza'   => $this->totaliza,
                     'activo'     => $this->activo ? 1 : 0,
                     'cto_gto1'   => $this->cto_gto1,
                     'cto_gto2'   => $this->cto_gto2,
                     'cto_gto3'   => $this->cto_gto3,
                     ]);
        }
        $this->resetInputFields();
    }

    public function store()
    {
        $this->selected_id = null;

        $this->validate([
                'metro_desc' => "required | max:50",
                'fc'         => "required | numeric",
                ]);

        Metros::create([
                'tipo_id'     => $this->tipo_id,
                'entidad_id'  => $this->entidad_id,
                'metro_desc'  => $this->metro_desc,
                'totaliza'    => $this->totaliza,
                'activo'      => $this->activo ? 1 : 0,
                'fc'          => $this->fc,
                'cto_gto1'    => $this->cto_gto1,
                'cto_gto2'    => $this->cto_gto2,
                'cto_gto3'    => $this->cto_gto3,
            ]);

        $this->resetInputFields();
    }

    public function activar($id)
    {
        if ($id)
        {
            $record = Metros::find($id);
            $record->update([ 'activo' => 1,
                     ]);
        }
    }

    public function desactivar($id)
    {
        if ($id)
        {
            $record = Metros::find($id);
            $record->update([ 'activo' => 0,
                     ]);
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
        // cambio despues de GIT
        //otro
    }
}
