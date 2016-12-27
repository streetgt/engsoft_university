<?php

namespace App\Http\Controllers;

use App\Course;
use App\Discipline;
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

    public function getGrades($id)
    {
        $student = Student::find($id);

        if($student == null)
        {
            return response()->json([
                'status'  => 404,
                'message' => 'Student not found!'
            ]);
        }

        $grades = $student->grades;

        return response()->json($grades);
    }

    public function enrollCourse(Request $request)
    {
        $course = Course::find($request->input('course_id'));

        if ($course == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Course not found!'
            ]);
        }

        $student = Student::where('token',$request->input('token'))->first();

        if ($student == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Token is invalid!'
            ]);
        }

        if($student->courses->has($course->id))
        {
            $student->courses()->detach($course->id);

            return response()->json([
                'status'  => 500,
                'message' => 'Student ' . $student->id . ' has been removed from course ' . $course->id,
            ]);
        } else {
            $student->courses()->attach($course->id);

            return response()->json([
                'status'  => 500,
                'message' => 'Student ' . $student->id . ' has added to course ' . $course->id,
            ]);
        }
    }

    public function enrollDiscipline(Request $request)
    {
        $course = Discipline::find($request->input('discipline_id'));

        if ($course == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Discipline not found!'
            ]);
        }

        $student = Student::where('token',$request->input('token'))->first();

        if ($student == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Token is invalid!'
            ]);
        }
    }
}
