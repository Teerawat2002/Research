<?php

namespace App\Http\Controllers;

use App\Models\Base\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Base\AcademicYear;
use App\Models\Base\ProjectGroup;

class TeacherController extends Controller
{
    public function index()
    {
        $advisor = Auth::guard('advisors')->user();

        return view('teacher.dashboard', compact('advisor'));
    }

    public function calendarIndex()
    {
        $calendarData = Calendar::with('academic_year')->get();
        return view('teacher.calendar.index', compact('calendarData'));
    }

    public function calendarCreate()
    {
        // Fetch all academic years
        $academic_years = AcademicYear::all();
        return view('teacher.calendar.create', compact('academic_years'));
    }

    public function calendarStore(Request $request)
    {
        // dd($request->all());
        // Validate the incoming data
        $request->validate([
            'ac_id' => ['required', 'exists:academic_years,id'],
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new calendar entry
        Calendar::create([
            'ac_id' => $request->ac_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('teacher.calendar.index')->with('success', 'Calendar entry created successfully.');
    }

    public function calendarHome()
    {
        // Get the logged-in user's ac_id
        $userAcId = Auth::user()->ac_id;

        $calendarData = Calendar::with('academic_year')
            ->where('ac_id', $userAcId)
            ->get();

        return view('teacher.calendar.home', compact('calendarData'));
    }

    public function proposeProject()
    {
        $group = ProjectGroup::with('academic_year')->get();
            
        return view('teacher.calendar.home', compact('calendarData'));
    }
}
