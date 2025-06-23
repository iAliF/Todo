<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OTPLoginController extends Controller
{
    public function create()
    {
        return view('layout');
    }
}
