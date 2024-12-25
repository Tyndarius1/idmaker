<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function student() {
        return view('student-home');
    }

    public function index() {
        return view('student-create.create');
    }

    public function saveStudent(Request $request)
    {
        // Validate input fields
        $validated = $request->validate([
            'student_id' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'birth_date' => 'required|date',
            'course' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        // Check if the student already exists
        $existingStudent = Student::where('student_id', $validated['student_id'])->first();

        if ($existingStudent) {
            // If student already exists, return a message that data has already been saved
            return redirect()->back()->with('message', 'This student data has already been saved.');
        }

        // Handle image upload (if a file is provided)
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // Store the image in the 'public/profile_images' directory
            $path = $file->storeAs('public/profile_images', $filename);
        } else {
            // If no image is uploaded, set a default image
            $path = 'default.png';
        }

        // Save student data to the database (including the image path)
        Student::create([
            'student_id' => $validated['student_id'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'address' => $validated['address'],
            'birth_date' => $validated['birth_date'],
            'course' => $validated['course'],
            'profile_image' => $path,  // Save the image path in the database
        ]);

        return redirect()->back()->with('success', 'Student data saved successfully!');
    }


    public function adminHome()
    {
        // Get all student records from the database
        $students = Student::all();

        // Pass the students to the admin-home view
        return view('admin-home', compact('students'));
    }


}
