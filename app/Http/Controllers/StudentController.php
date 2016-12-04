<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @var
     */
    protected $student;

    /**
     * StudentController constructor.
     * @param Student $student
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $students = $this->student->all();

        return response()->json($students);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStudent($id)
    {

        $student = $this->student->find($id);

        return response()->json($student);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createStudent(Request $request)
    {
        $student = $this->student->create($request->all());

        return response()->json($student);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteStudent($id)
    {
        $student = $this->student->find($id);
        $student->delete();

        return response()->json([
            'status'  => 500,
            'message' => 'Student removed with success!',
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request, $id)
    {
        $student = $this->student->find($id);
        $student->name = $request->input('name');
        $student->surname = $request->input('surname');
        $student->ssn = $request->input('ssn');
        $student->birthdate = $request->input('birthdate');
        $student->gpa = $request->input('gpa');
        $student->gender = $request->input('gender');
        $student->save();

        return response()->json($student);
    }
}
