<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalonController extends Controller
{
    public function homepage()
    {
        return view('salon.homepage');
    }
}
