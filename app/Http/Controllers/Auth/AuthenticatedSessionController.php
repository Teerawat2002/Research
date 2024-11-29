<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $credentials = $request->only(['id', 'password']);

    //     // Attempt login as student
    //     if (Auth::guard('students')->attempt(['s_id' => $credentials['id'], 'password' => $credentials['password']])) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/student/group/index');
    //     }

    //     // Attempt login as advisor
    //     if (Auth::guard('advisors')->attempt(['a_id' => $credentials['id'], 'password' => $credentials['password']])) {
    //         $request->session()->regenerate();

    //         // Get the authenticated user
    //         $advisor = Auth::guard('advisors')->user();

    //         // Debugging a_type
    //         // dd($advisor->a_type); // หยุดโปรแกรมเพื่อดูค่าของ a_type

    //         // Redirect based on a_type
    //         switch ($advisor->a_type) {
    //             case 'admin':
    //                 return redirect()->intended('admin/advisor/index');
    //             case 'teacher':
    //                 return redirect()->intended('teacher/dashboard');
    //             case 'advisor':
    //                 return redirect()->intended('advisor/propose/index');
    //             default:
    //                 return redirect()->intended('/dashboard'); // Default fallback route
    //         }
    //     }

    //     // Authentication failed
    //     return back()->withErrors([
    //         'login' => 'Invalid ID or password.',
    //     ]);
    // }

    /**
     * Destroy an authenticated session.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only(['id', 'password']);
        if (Auth::guard('students')->attempt(['s_id' => $credentials['id'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->route('student.group.index');
        }
        if (Auth::guard('advisors')->attempt(['a_id' => $credentials['id'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            $advisor = Auth::guard('advisors')->user();
            switch ($advisor->a_type) {
                case 'admin':
                    return redirect()->route('admin.advisor.index');
                case 'teacher':
                    return redirect()->route('teacher.calendar.index');
                case 'advisor':
                    return redirect()->route('advisor.propose.index');
                default:
                    return redirect()->route('dashboard');
            }
        }
        return back()->withErrors([
            'login' => 'Invalid ID or password.',
        ]);
    }
    public function studentLogout(Request $request)
    {
        if (Auth::guard('students')->check()) {
            Auth::guard('students')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('welcome')->with('success', 'You have been logged out.');
    }

    public function advisorLogout(Request $request)
    {
        if (Auth::guard('advisors')->check()) {
            Auth::guard('advisors')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('welcome')->with('success', 'You have been logged out.');
    }
}
