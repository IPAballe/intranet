<?php

namespace App\Http\Livewire;

use App\Models\Metros;
use Livewire\Component;
use Livewire\WithPagination;

class LiveMetros extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $campo = null;
    public $order = null;
    public $icono = '-circle';

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

    public function render()
    {
        $metros = Metros::where('metro_desc','like',"%{$this->search}%");

        if ( $this->campo && $this->order )
        {
            $metros = $metros->orderBy($this->campo, $this->order);
        }
        $metros = $metros->paginate($this->perPage);
        return view('livewire.live-metros', [
                                             'metros'=> $metros,
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

    public function mount()
    {
        $this->icono = $this->iconDirection($this->order);
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

    public function edit($id)
    {
        $record = Metros::findOrFail($id);

        $this->selected_id = $id;
        $this->metro_desc  = $record->metro_desc;
        $this->fc          = $record->fc;
        $this->totaliza    = $record->totaliza;
        $this->cto_gto1    = $record->cto_gto1;
        $this->cto_gto2    = $record->cto_gto2;
        $this->cto_gto3    = $record->cto_gto3;
        $this->entidad_id  = $record->entidad_id;
        $this->metro_id    = $record->metro_id;
    }

    public function update()
    {
         $this->validate([
               'metro_desc' => "required",
               'fc'         => "required | numeric",
               'cto_gto1'   => "digitos:4",
               'cto_gto2'   => "digitos:4",
               'cto_gto3'   => "digitos:4",
               ]);

        if($this->selected_id)
        {
            $record = Metros::find($this->selected_id);
            $record->update([
                     'plan' => $this->plan,
                     ]);
        }

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

    public function createModal()
    {
        $this->selected_id = null;
    }
}
