<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeList extends Component
{
    use WithPagination;

    public function render()
    {
        $employees = Employee::all();

        return view('livewire.employee-list',['trabajadores'=>$employees]);
    }


}
