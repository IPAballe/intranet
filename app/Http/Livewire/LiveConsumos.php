<?php

namespace App\Http\Livewire;

use App\Models\Lecturas;
use App\Models\Metros;
use Carbon\Carbon;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;

class LiveConsumos extends Component
{
    public $tipo = 1;
    public $metro_id = 0;
    public $ano_mes, $dias;

    public function mount()
    {
        $this->ano_mes = Carbon::now()->Format('Y-m');
    }

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

    public function lecturaAnterior($metro_id, $fecha)
    {
        $record = Lecturas::where('metro_id',$metro_id)
                          ->where('fecha','<', $fecha)
                          ->orderBy('fecha', 'desc')
                          ->get(1);
        return [$record->fecha,$record->lectura];
    }

    public function calculaConsumo()
    {
      $dia_ini = Carbon::createFromFormat('Y-m-d',$this->ano_mes.'01');
      $dia_fin = Carbon::createFromFormat('Y-m-d',$this->ano_mes.'01');

    }


}
