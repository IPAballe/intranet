<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnergiaController extends Controller
{
    //

    public function entidades()
    {
        return view('energia.entidades');
    }

    public function lecturas()
    {
        return view('energia.lecturalistado');
    }

    public function planes()
    {
        return view('energia.planes');
    }

    public function consumos()
    {
        return view('energia.consumos');
    }
}
