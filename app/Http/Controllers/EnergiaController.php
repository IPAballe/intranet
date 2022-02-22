<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnergiaController extends Controller
{
    //
    public function lecturas()
    {
        return view('energia.lecturalistado');
    }

    public function planes()
    {
        return view('energia.planes');
    }
}
