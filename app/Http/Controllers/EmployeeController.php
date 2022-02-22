<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //
    public function listadoGeneral()
    {
        $listadoGeneral = Employee::all();
        return view('listado',['listadoGeneral'=>$listadoGeneral]);
    }


}
