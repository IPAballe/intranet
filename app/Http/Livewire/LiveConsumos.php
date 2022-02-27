<?php

namespace App\Http\Livewire;

use App\Models\Lecturas;
use App\Models\Metros;
use App\Models\Planes;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;


class LiveConsumos extends Component
{
    public $tipo = 1;  // ENERGIA ELECTRICA
    public $metros, $metro_id = 0;
    public $dias, $ano_mes, $Consumos, $consumo, $um, $ddm;

    protected $intervalo, $temp;

    public function mount()
    {
        $this->ano_mes  = Carbon::now()->Format('Y-m');
        $this->metros   = Metros::where('tipo_id', $this->tipo)
                          ->where('activo','1')
                          ->orderBy('metro_desc', 'asc')
                          ->get();

        $this->metro_id = $this->metros->first()->id;
        $this->um = $this->metros->first()->um;

        $this->planes = Planes::where('metro_id', $this->metro_id)
                              ->where('ano', Carbon::createFromFormat('Y-m-d', $this->ano_mes.'-01')->format('Y'))
                              ->where('mes', Carbon::createFromFormat('Y-m-d', $this->ano_mes.'-01')->format('m'))
                              ->first();
    }

    public function render()
    {
        $this->planes = Planes::where('metro_id', $this->metro_id)
                              ->where('ano', Carbon::createFromFormat('Y-m-d', $this->ano_mes.'-01')->format('Y'))
                              ->where('mes', Carbon::createFromFormat('Y-m-d', $this->ano_mes.'-01')->format('m'))
                              ->first();
        $this->intervalo = CarbonPeriod::create(Carbon::createFromFormat('Y-m-d', $this->ano_mes.'-01'),
                                                Carbon::createFromFormat('Y-m', $this->ano_mes)->endOfMonth());
        $this->ddm = Carbon::createFromFormat('Y-m', $this->ano_mes)->endOfMonth()->format('d');
        $this->consumoPeriodo($this->intervalo, $this->metro_id);
        return view('livewire.live-consumos', [
                                                'Consumos'=> $this->Consumos,
                                                'Planes'  => $this->planes,
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
        $this->consumo= null;
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
        $this->Consumos = null;
        foreach ($period as $d)
        {
            $this->Consumos[$d->format('Y-m-d')] = $this->ConsumoDia($d->format('Y-m-d'), $metro_id);
        }
    }


}

