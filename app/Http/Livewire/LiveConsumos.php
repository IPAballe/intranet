<?php

namespace App\Http\Livewire;

use App\Models\Lecturas;
use App\Models\Metros;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;

class LiveConsumos extends Component
{
    public $tipo = 1;  // ENERGIA ELECTRICA
    public $metro_id = 0;
    public $ano_mes, $dias;

    protected $intervalo;

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

        $this->calculaConsumo("2022-02-01","2022-02-05");

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

    public function calculaConsumo($ini, $fin)
    {

        $this->intervalo = CarbonPeriod::create(Carbon::createFromFormat('Y-m-d',$ini),
                                                 Carbon::createFromFormat('Y-m-d',$fin));


        foreach ($this->intervalo as $key =>$date)
        {
            if (!$loop->first)
            {

            }
            {

            }
            $this->consumos =

        }




    }


}
