<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    use HasFactory;

    public function metros()
    {
        return $this->hasMany(Metros::class,'metros_id','id');
    }
}
