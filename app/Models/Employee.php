<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected   $table          = 'Employees';
    protected   $primaryKey     = 'no_expediente';
    public      $incrementing   = false;
    protected   $keyType        = 'string';
    public      $timestamps     = false;



}
