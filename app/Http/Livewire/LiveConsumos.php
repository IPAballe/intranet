<?php

namespace App\Http\Livewire;

use App\Models\Lecturas;
use App\Models\Metros;
use Livewire\Component;

class LiveConsumos extends Component
{
    public $tipo = 1;
    public function render()
    {
        $metros = Metros::where('tipo_id', $this->tipo)
                        ->where('activo','1')
                        ->orderBy('metro_desc', 'asc')
                        ->get();
        return view('livewire.live-consumos', [
            'metros' => $metros,
        ]);
    }
}
