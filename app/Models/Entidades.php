<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidades extends Model
{
    use HasFactory;

    public $fillable = ['entidad_desc', 'munic_id', 'correo', 'telefono', 'activo'];

    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'munic_id', 'id');
    }
}
