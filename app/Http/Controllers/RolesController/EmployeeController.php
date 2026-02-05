<?php

namespace App\Http\Controllers\RolesController;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.home');
    }
}
