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
        $t = $this->metros->first();
        if (!is_null($t))
        {
            $this->metro_id = $t->id;
            $this->um = $this->metros->first()->tipo->um;

        }

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
        $recordSgt = Lecturas::where('fecha', '>', $f)
                              ->where('metro_id', $metro_id)
                              ->orderBy('fecha', 'asc')
                              ->first();
        $recordAnterior = Lecturas::where('fecha', '<=', $f)
                                  ->where('metro_id', $metro_id)
                                  ->orderBy('fecha', 'desc')
                                  ->first();
        $this->consumo= null;
        if (!is_null($recordSgt))
        if (!is_null($recordAnterior))
        {
            $fechaSgt = Carbon::createFromFormat('Y-m-d', $recordSgt->fecha->format('Y-m-d'));
            $lectuSgt = $recordSgt->lectura;
            $fechaAnterior = Carbon::createFromFormat('Y-m-d', $recordAnterior->fecha->format('Y-m-d'));
            $lectuAnterior = $recordAnterior->lectura;
            $this->consumo = ($lectuSgt - $lectuAnterior) /
                             ($fechaSgt->diffInDays($fechaAnterior));
        }
        return $this->consumo;
    }

    public function consumoPeriodo($period, $metro_id)
    {
        $this->Consumos = null;
        foreach ($period as $d)
            $this->Consumos[$d->format('Y-m-d')] =
                   $this->ConsumoDia($d->format('Y-m-d'), $metro_id);
    }
}
