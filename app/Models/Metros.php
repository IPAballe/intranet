<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tipos;

class Metros extends Model
{
    use HasFactory;

    public $fillable = ['metro_desc','fc','totaliza','activo',
                        'cto_gto1','cto_gto2','cto_gto3',
                        'entidad_id','tipo_id'
                       ];

    public function entidad()
    {
        return $this->belongsTo(Entidades::class, 'entidad_id', 'id');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipos::class, 'tipo_id', 'id');
    }
}
