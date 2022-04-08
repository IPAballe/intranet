<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Lecturas extends Model
{
    use HasFactory;

    protected $dates = ['fecha', 'createt_at', 'updated_at'];

    protected $casts = ['fecha'=> 'date:Y-m-d'];

    protected $dateFormat = 'Y-m-d';


    public $fillable = ['fecha','lectura','cambiometro','metro_id'];

    public function metro()
    {
        return $this->belongsTo(Metros::class, 'metro_id', 'id');
    }




}
