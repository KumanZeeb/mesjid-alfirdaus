<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfaqController extends Controller
{
    public function index()
    {
        return view('infaq');
    }
}