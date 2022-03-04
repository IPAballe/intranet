<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    use HasFactory;

    public $fillable = ['plan', 'ano', 'mes', 'metro_id'];

    public function metro()
    {
        return $this->belongsTo(Metros::class, 'metro_id','id');
    }
}
