<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvisorController extends Controller
{
    // public function advisorIndex()
    // {
    //     return view('advisor.dashboard');
    // }

    public function index()
    {
        $advisor = Auth::guard('advisors')->user();

        return view('advisor.dashboard', compact('advisor'));
    }
}
