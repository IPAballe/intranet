<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnergiaController extends Controller
{
    // Cambio para

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

    public function consumos_dia()
    {
        return view('energia.consumos_dia');
    }

    public function consumos_mes()
    {
        return view('energia.consumos_mes');
    }
}
