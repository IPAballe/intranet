<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturas extends Model
{
    use HasFactory;

    public $fillable = ['fecha','lectura','cambiometro','metro_id'];

    public function metro()
    {
        return $this->belongsTo(Metros::class, 'metro_id', 'id');
    }
/*
    protected function getFechaAttribute($value)
    {
       return $this->attributes['created_at'] = Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d');
    }
*/


}
