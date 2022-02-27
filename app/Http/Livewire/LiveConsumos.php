<?php

namespace App\Http\Livewire;

use App\Models\Lecturas;
use App\Models\Metros;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use Illuminate\Support\Arr;

class LiveConsumos extends Component
{
    public $tipo = 1;  // ENERGIA ELECTRICA
    public $metros, $metro_id = 0;
    public $ano_mes, $dias, $Consumos, $consumo;

    protected $intervalo, $temp;

    public function mount()
    {
        $this->ano_mes  = Carbon::now()->Format('Y-m');
        $this->metros   = Metros::where('tipo_id', $this->tipo)
                          ->where('activo','1')
                          ->orderBy('metro_desc', 'asc')
                          ->get();
        $this->metro_id = $this->metros->first()->id;

    }

    public function render()
    {
        $intervalo = CarbonPeriod::create(Carbon::createFromFormat('Y-m-d', $this->ano_mes.'-01'),
                                          Carbon::createFromFormat('Y-m-d', $this->ano_mes.'-28'));
        $this->consumoPeriodo($intervalo, $this->metro_id);
        return view('livewire.live-consumos', [
            'Consumos'=> $this->Consumos,
        ]);
    }

    public function ConsumoDia($f, $metro_id)
    {
        $fecha = Carbon::createFromFormat('Y-m-d', $f);

        $recordActualoSgt = Lecturas::where('fecha', '>=', $fecha)
                                    ->where('metro_id', $metro_id)
                                    ->orderBy('fecha', 'asc')
                                    ->first();
        $recordAnterior = Lecturas::where('fecha', '<', $fecha)
                                  ->where('metro_id', $metro_id)
                                  ->orderBy('fecha', 'desc')
                                  ->first();

        if (!is_null($recordActualoSgt))
        if (!is_null($recordAnterior))
        {
            $fechaActualoSgt = Carbon::createFromFormat('Y-m-d', $recordActualoSgt->fecha);
            $lectuActualoSgt = $recordActualoSgt->lectura;

            $fechaAnterior = Carbon::createFromFormat('Y-m-d', $recordAnterior->fecha);
            $lectuAnterior = $recordAnterior->lectura;

            $this->consumo = ($lectuActualoSgt - $lectuAnterior) /
                       ($fechaActualoSgt->diffInDays($fechaAnterior));
        }
        return $this->consumo;
    }

    public function consumoPeriodo($period, $metro_id)
    {

        foreach ($period as $date)
        {
            $Consumos = collect([
                         'fecha' => $date->format('Y-m-d'),
                         'valor' => $this->ConsumoDia($date->format('Y-m-d'), $metro_id)
                        ]);
        }
        dd($Consumos);

    }


}
