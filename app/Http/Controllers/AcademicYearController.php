<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advisor;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\Auth;

class AcademicYearController extends Controller
{
    public function create()
    {
        return view('admin.academic-year.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2500',
        ]);

        AcademicYear::create($validated);

        return redirect()->route('admin.academic-year.index')->with('success', 'Academic year created successfully!');
    }
}
