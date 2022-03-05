<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $listadoGeneral;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function listadoGeneral()
    {
        $listadoGeneral = Employee::all();
        return view('listado',['listadoGeneral'=>$listadoGeneral]);
    }

}
