<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\School;
use Illuminate\Http\Request;

class StudentController extends Controller
{
        public function index()
    {
        $students = Student::with('school')->paginate(5);
        return view('students.index', compact('students'));
    }
    public function create()
    {
        $schools = School::all();
        return view('students.create', compact('schools'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_id'  => 'required|exists:schools,id',
            'full_name'  => 'required',
            'student_id' => 'required|unique:students,student_id',
            'email'      => 'required|email',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Thêm sinh viên thành công');
    }


    public function edit(Student $student)
    {
        $schools = School::all();
        return view('students.edit', compact('student', 'schools'));
    }
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'school_id'  => 'required|exists:schools,id',
            'full_name'  => 'required',
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'email'      => 'required|email',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Cập nhật sinh viên thành công');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Xóa sinh viên thành công');
    }
}
