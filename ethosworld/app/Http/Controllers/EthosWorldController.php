<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EthosWorldController extends Controller
{
    public function index()
    {
        return view('ethosworld/index');
    }
}
