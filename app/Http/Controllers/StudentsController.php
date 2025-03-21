<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Students::all();
        return view('studentList', compact('students'));
    }
    public function newStudent(Request $request)
    {
        $request->validate([
            'stdName' => 'required|max:255',
            'stdAge' => 'required|numeric',
            'stdGender' => 'required|max:255',
        ]);
        Students::create([
            'name' => $request->stdName,
            'age' => $request->stdAge,
            'gender' => $request->stdGender,
        ]);

        return redirect()->route('std.index')->with('success', 'Student created successfully.');
    }

    public function updateStudent(Request $request, $id)
{
    $request->validate([
        'stdName' => 'required|max:255',
        'stdAge' => 'required|numeric',
        'stdGender' => 'required|max:255',
    ]);

    $student = Students::findOrFail($id);
    $student->name = $request->stdName;
    $student->age = $request->stdAge;
    $student->gender = $request->stdGender;
    $student->save();

    return redirect()->route('std.index')->with('success', 'Student updated successfully.');
}
public function deleteStudent($id)
{

    $student = Students::findOrFail($id);
    $student->delete();

    return redirect()->route('std.index')->with('success', 'Student deleted successfully.');
}
}