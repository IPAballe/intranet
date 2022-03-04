<?php

namespace App\Http\Controllers;

use App\Models\Metros;
use Illuminate\Http\Request;

class MetroController extends Controller
{
    //
    public function listado()
    {
        return view('energia.metrolistado');
    }
}
