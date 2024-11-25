<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advisor;
use App\Models\AcademicYear;
use App\Models\Major;
use Illuminate\Support\Facades\Auth;

class MajorController extends Controller
{
    public function index()
    {
        $advisor = Auth::guard('advisors')->user();
        $Major = Major::orderBy('id', 'asc')->get();

        return view('admin.major.index', compact('advisor', 'Major'));
    }

    public function create()
    {
        return view('admin.major.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'm_name' => ['required', 'string', 'max:255'],
        ]);

        Major::create([
            'm_name' => $request->m_name,
        ]);

        return redirect()->route('admin.major.index')->with('success', 'Major created successfully!');
    }
}
