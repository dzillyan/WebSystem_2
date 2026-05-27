<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{
    public function index(Request $request)
{
    $query = Student::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('course', 'like', "%{$search}%");
        });
    }

    $students = $query->get()->map(function ($student) {
        $student->qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)
            ->generate(route('students.show', $student->id));
        return $student;
    });

    return view('students.index', compact('students'));
}


    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email|unique:students',
            'phone'   => 'required',
            'course'  => 'required',
            'picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'course']);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('students', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $qr = QrCode::size(200)->generate(json_encode([
            'id'     => $student->id,
            'name'   => $student->name,
            'email'  => $student->email,
            'phone'  => $student->phone,
            'course' => $student->course,
        ]));

        return view('students.show', compact('student', 'qr'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email|unique:students,email,' . $student->id,
            'phone'   => 'required',
            'course'  => 'required',
            'picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'course']);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('students', 'public');
        }

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
