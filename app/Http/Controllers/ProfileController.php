<?php

namespace App\Http\Controllers;

use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $student = Auth::guard('student')->user();
        $recentLogs = $student->logs()->latest()->take(10)->get();

        SystemLog::record(
            SystemLog::EVENT_PAGE_VISIT,
            "Visited profile settings page",
            $student->id
        );

        return view('profile.settings', compact('student', 'recentLogs'));
    }

    public function update(Request $request)
    {
        $student = Auth::guard('student')->user();

        $validated = $request->validate([
            'first_name'       => 'required|string|max:100',
            'last_name'        => 'required|string|max:100',
            'middle_name'      => 'nullable|string|max:100',
            'email'            => 'required|email|unique:students,email,' . $student->id,
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
            'profile_photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Track old values for the log
        $oldValues = $student->only(array_keys($validated));
        unset($oldValues['profile_photo']);

        // Handle photo upload
        if ($request->hasFile('profile_photo')) {
            if ($student->profile_photo) {
                Storage::disk('public')->delete($student->profile_photo);
            }
            $validated['profile_photo'] = $request->file('profile_photo')
                ->store('profile_photos', 'public');
        } else {
            unset($validated['profile_photo']);
        }

        $newValues = array_filter($validated, fn($k) => $k !== 'profile_photo', ARRAY_FILTER_USE_KEY);

        $student->update($validated);

        SystemLog::record(
            SystemLog::EVENT_PROFILE_UPDATE,
            "Profile updated by {$student->full_name}",
            $student->id,
            'success',
            $oldValues,
            $newValues
        );

        return back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'current_password' => 'required',
            'password'         => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        if (!Hash::check($request->current_password, $student->password)) {
            SystemLog::record(
                SystemLog::EVENT_PASSWORD_CHANGE,
                "Failed password change attempt by {$student->full_name}",
                $student->id,
                'failed'
            );
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $student->update(['password' => Hash::make($request->password)]);

        SystemLog::record(
            SystemLog::EVENT_PASSWORD_CHANGE,
            "Password changed successfully by {$student->full_name}",
            $student->id
        );

        return back()->with('success', 'Password changed successfully!');
    }

    public function dashboard()
    {
        $student  = Auth::guard('student')->user();
        $allLogs  = $student->logs()->latest()->take(20)->get();
        $logCount = $student->logs()->count();

        SystemLog::record(
            SystemLog::EVENT_PAGE_VISIT,
            "Visited dashboard",
            $student->id
        );

        return view('dashboard.index', compact('student', 'allLogs', 'logCount'));
    }
}