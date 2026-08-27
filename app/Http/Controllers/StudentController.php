<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a new student in the database.
     */
    public function store(Request $request)
    {
        // 1. Validate all input
        $validated = $request->validate([
            'student_id'     => 'required|unique:students,student_id',
            'first_name'     => 'required|string|max:100',
            'middle_name'    => 'nullable|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|unique:students,email',
            'mobile_number'  => 'required|numeric|digits_between:10,15',
            'date_of_birth'  => 'required|date',
            'gender'         => 'required|in:Male,Female,Other',
            'program'        => 'required|string|max:100',
            'year_level'     => 'required|string|max:20',
            'address'        => 'required|string|max:500',
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // 2. Upload profile picture
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        // 3. Save to database
        $student = Student::create($validated);

        // 4. Flash success message and redirect to profile page
        return redirect()->route('students.show', $student)
            ->with('success', 'Student registered successfully!');
    }

    /**
     * Display a student's profile.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }
}