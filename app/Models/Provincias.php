<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincias extends Model
{
    use HasFactory;

    public function municipio()
    {
        return $this->hasMany(Municipios::class, 'munic_id', 'id');
    }
}
