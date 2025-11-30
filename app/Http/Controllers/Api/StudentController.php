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
            'message' => 'Students retrieved successfully',
            'data' => $students,
            'total' => $students->count()
        ]);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'major' => 'required|string|max:255',
            'year' => 'required|integer|min:1|max:4'
        ]);

        // Create student in database
        $student = Student::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student created successfully',
            'data' => $student
        ], 201); // 201 = Created
    }

    public function show(Student $student)
    {
        return response()->json([
            'success' => true,
            'message' => 'Student retrieved successfully',
            'data' => $student
        ]);
    }


    public function update(Request $request, Student $student)
    {
        // Validate request data (sometimes = only validate if field is present)
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
            'major' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer|min:1|max:4'
        ]);

        // Update student in database
        $student->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully',
            'data' => $student->fresh() // fresh() reloads from database
        ]);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully'
        ]);
    }

    public function getByMajor($major)
    {
        $students = Student::where('major', $major)->get();

        return response()->json([
            'success' => true,
            'message' => "Students in {$major} retrieved successfully",
            'data' => $students,
            'total' => $students->count()
        ]);
    }

    public function getByYear($year)
    {
        $students = Student::where('year', $year)->get();

        return response()->json([
            'success' => true,
            'message' => "Year {$year} students retrieved successfully",
            'data' => $students,
            'total' => $students->count()
        ]);
    }

    public function search(Request $request)
    {
        $name = $request->query('name');
        
        if (!$name) {
            return response()->json([
                'success' => false,
                'message' => 'Name parameter is required'
            ], 400);
        }

        $students = Student::where('name', 'like', '%' . $name . '%')->get();

        return response()->json([
            'success' => true,
            'message' => "Search results for '{$name}'",
            'data' => $students,
            'total' => $students->count()
        ]);
    }

    public function stats()
    {
        $totalStudents = Student::count();
        $studentsByYear = [];
        $studentsByMajor = [];

        // Count students by year
        for ($year = 1; $year <= 4; $year++) {
            $studentsByYear["year_{$year}"] = Student::where('year', $year)->count();
        }

        // Count students by major
        $majors = Student::distinct('major')->pluck('major');
        foreach ($majors as $major) {
            $studentsByMajor[$major] = Student::where('major', $major)->count();
        }

        return response()->json([
            'success' => true,
            'message' => 'Database statistics retrieved successfully',
            'data' => [
                'total_students' => $totalStudents,
                'students_by_year' => $studentsByYear,
                'students_by_major' => $studentsByMajor,
                'latest_student' => Student::latest()->first(),
                'oldest_student' => Student::oldest()->first()
            ]
        ]);
    }

}
