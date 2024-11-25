<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Major;
use App\Models\AcademicYear;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $advisor = Auth::guard('advisors')->user();

        return view('admin.dashboard', compact('advisor'));
    }


    // Advisor Setting
    public function advisorIndex()
    {
        $advisor = Auth::guard('advisors')->user();
        $advisorUser = Advisor::with(['major'])->orderBy('id', 'asc')->get();

        return view('admin.advisor.index', compact('advisor', 'advisorUser'));
    }

    public function advisorCreate()
    {
        $majors = Major::all();
        return view('admin.advisor.create', compact('majors'));
    }

    public function advisorStore(Request $request)
    {
        $request->validate([
            'a_id' => ['required', 'string', 'max:255', 'unique:advisors'],
            'a_fname' => ['required', 'string', 'max:255'],
            'a_lname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8'], // Ensure password confirmation
            'a_type' => ['required', 'in:advisor,teacher,admin'], // Validate type
            'm_id' => ['required', 'exists:majors,id'], // Validate major ID
        ]);

        Advisor::create([
            'a_id' => $request->a_id,
            'a_fname' => $request->a_fname,
            'a_lname' => $request->a_lname,
            'a_password' => Hash::make($request->password), // Hash the password
            'a_type' => $request->a_type,
            'm_id' => $request->m_id,
            'status' => 'active',
        ]);

        return redirect()->route('admin.advisor.index')->with('success', 'Advisor created successfully!');
    }

    public function academicYearIndex()
    {
        $advisor = Auth::guard('advisors')->user();
        $academicYear = AcademicYear::orderBy('id', 'asc')->get();

        return view('admin.academic-year.index', compact('advisor', 'academicYear'));
    }


    // Student Setting
    public function studentIndex()
    {
        $advisor = Auth::guard('advisors')->user();
        $Student = Student::with(['academic_year'])->orderBy('id', 'asc')->get();

        return view('admin.student.index', compact('advisor', 'Student'));
    }

    public function studentCreate()
    {
        $academicYears = AcademicYear::all(); // Fetch all academic years
        $majors = Major::all(); // Fetch all majors
        return view('admin.student.create', compact('academicYears', 'majors'));
    }

    public function studentStore(Request $request)
    {
        // dd($request->all());

        $request->validate([
            's_id' => ['required', 'string', 'max:255', 'unique:students'],
            's_fname' => ['required', 'string', 'max:255'],
            's_lname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8'], // Ensure password confirmation
            'm_id' => ['required', 'exists:majors,id'], // Validate major ID from the 'majors' table
            'ac_id' => ['required', 'exists:academic_years,id'], // Validate academic year from the 'academic_years' table
        ]);

        // dd('Validation passed!');

        Student::create([
            's_id' => $request->s_id,
            's_fname' => $request->s_fname,
            's_lname' => $request->s_lname,
            's_password' => Hash::make($request->password), // Hash the password
            'm_id' => $request->m_id,
            'ac_id' => $request->ac_id,
            'status' => 'active',
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Student created successfully!');
    }
}
