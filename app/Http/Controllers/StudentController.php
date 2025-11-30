<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    
    public function index()
    {
        $students = Student::all();
        return response()->json([
            'success' => true,
            'data' => $students
        ]);
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'major' => 'required|string|max:255',
            'year'  => 'required|integer|min:1|max:4'
        ]);

        $student = Student::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student created successfully!',
            'data' => $student
        ], 201);
    }

   
    public function show($id)
{
    $student = Student::find($id);

    if (!$student) {
        return response()->json([
            'success' => false,
            'message' => 'Student not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Student retrieved successfully',
        'data' => $student
    ],201);
}


    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'major' => 'required|string|max:255',
            'year'  => 'required|integer|min:1|max:4'
        ]);

        $student->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully!',
            'data' => $student
        ]);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully!'
        ]);
    }

    public function getByMajor($major)
    {
        $students = Student::where('major', $major)
                           ->orderBy('name', 'asc') 
                           ->get();

        if ($students->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "No students found in major: {$major}",
                'data' => []
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "Students in major '{$major}' retrieved successfully",
            'data' => $students,
            'total' => $students->count()
        ]);
    }

    public function getByYear($year)
{
    $students = Student::where('year', $year)
                       ->orderBy('name', 'asc') 
                       ->get();

    if ($students->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => "No students found in year: {$year}",
            'data' => []
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => "Students in year '{$year}' retrieved successfully",
        'data' => $students,
        'total' => $students->count()
    ]);
}


}