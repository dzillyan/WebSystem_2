<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ─── Show Login ────────────────────────────────────────────────────────────

    public function showLogin()
    {
        if (Auth::guard('student')->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    // ─── Login ─────────────────────────────────────────────────────────────────

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $student = Student::where('email', $request->email)->first();

        if (!$student) {
            SystemLog::record(
                SystemLog::EVENT_LOGIN_FAILED,
                "Failed login attempt for email: {$request->email} — account not found",
                null,
                'failed'
            );
            return back()->withErrors(['email' => 'No account found with this email.'])->withInput();
        }

        if ($student->status === 'suspended') {
            SystemLog::record(
                SystemLog::EVENT_LOGIN_FAILED,
                "Login attempt by suspended student: {$student->full_name}",
                $student->id,
                'warning'
            );
            return back()->withErrors(['email' => 'Your account has been suspended. Please contact the registrar.'])->withInput();
        }

        if (!Hash::check($request->password, $student->password)) {
            SystemLog::record(
                SystemLog::EVENT_LOGIN_FAILED,
                "Invalid password for: {$student->email}",
                $student->id,
                'failed'
            );
            return back()->withErrors(['password' => 'Incorrect password.'])->withInput();
        }

        Auth::guard('student')->login($student, $request->boolean('remember'));

        SystemLog::record(
            SystemLog::EVENT_LOGIN,
            "Student logged in: {$student->full_name} ({$student->student_id})",
            $student->id
        );

        return redirect()->route('dashboard')->with('success', "Welcome back, {$student->first_name}!");
    }

    // ─── Show Registration ──────────────────────────────────────────────────────

    public function showRegister()
    {
        if (Auth::guard('student')->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    // ─── Register ──────────────────────────────────────────────────────────────

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name'       => 'required|string|max:100',
            'last_name'        => 'required|string|max:100',
            'middle_name'      => 'nullable|string|max:100',
            'email'            => 'required|email|unique:students,email',
            'password'         => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'phone_number'     => 'required|string|max:20',
            'date_of_birth'    => 'required|date|before:-15 years',
            'gender'           => 'required|in:Male,Female,Other',
            'address'          => 'required|string|max:255',
            'city'             => 'required|string|max:100',
            'province'         => 'required|string|max:100',
            'zip_code'         => 'required|string|max:10',
            'course'           => 'required|string|max:150',
            'year_level'       => 'required|in:1st Year,2nd Year,3rd Year,4th Year,5th Year',
            'guardian_name'    => 'nullable|string|max:150',
            'guardian_contact' => 'nullable|string|max:20',
        ]);

        $validated['student_id'] = $this->generateStudentId();
        $validated['password']   = Hash::make($validated['password']);

        $student = Student::create($validated);

        SystemLog::record(
            SystemLog::EVENT_REGISTER,
            "New student registered: {$student->full_name} — Course: {$student->course}",
            $student->id
        );

        Auth::guard('student')->login($student);

        return redirect()->route('dashboard')
            ->with('success', "Welcome, {$student->first_name}! Your Student ID is <strong>{$student->student_id}</strong>.");
    }

    // ─── Logout ────────────────────────────────────────────────────────────────

    public function logout(Request $request)
    {
        $student = Auth::guard('student')->user();

        if ($student) {
            SystemLog::record(
                SystemLog::EVENT_LOGOUT,
                "Student logged out: {$student->full_name} ({$student->student_id})",
                $student->id
            );
        }

        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    private function generateStudentId(): string
    {
        $year = date('Y');
        $last = Student::whereYear('created_at', $year)->count() + 1;
        return 'STU-' . $year . '-' . str_pad($last, 4, '0', STR_PAD_LEFT);
    }
}