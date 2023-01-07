<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index()
    {
        return view('investment.index');
    }
}
