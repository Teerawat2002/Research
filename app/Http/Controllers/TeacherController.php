<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $advisor = Auth::guard('advisors')->user();

        return view('teacher.dashboard', compact('advisor'));
    }
}
