<?php

namespace App\Http\Controllers\RolesController;

use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.home');
    }
}
