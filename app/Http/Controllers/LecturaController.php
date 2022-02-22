<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturaController extends Controller
{
    //
    public function listado()
    {
        return view('energia.lecturalistado');
    }
}
