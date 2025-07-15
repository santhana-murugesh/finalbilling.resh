<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsContoller extends Controller
{
    public function report()
    {
        return view('report'); 
    }
}
