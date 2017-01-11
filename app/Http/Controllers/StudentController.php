<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Course;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use SoapBox\Formatter\Formatter;

/**
 * Class StudentController
 * @package App\Http\Controllers
 */
class StudentController extends Controller
{
    /**
     * @var
     */
    protected $user;

    /**
     * StudentController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display all Students
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $students = $this->user->allStudents()->get();

        return response()->json($students);
    }

    /**
     * Display a Student
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStudent($id)
    {
        $student = $this->user->find($id);

        if ($student == null || ! $student->isStudent()) {
            return response()->json([
                'status'  => 400,
                'message' => 'The Student ID provided is not a student or not found!'
            ]);
        }

        return response()->json($student);
    }

    /**
     * Create a Student
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createStudent(Request $request)
    {
        $this->middleware('employee');

        $student = $this->user->create($request->all());

        $student->roles()->create([
           'role' => Role::STUDENT
        ]);

        return response()->json($student);
    }

    /**
     * Deletes a Student
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteStudent($id)
    {
        $this->middleware('employee');

        $student = $this->user->find($id);

        if ($student == null || ! $student->isStudent()) {
            return response()->json([
                'status'  => 400,
                'message' => 'The Student ID provided is not a student or not found!'
            ]);
        }

        $student->delete();

        $role = Role::where('user_id',$student->id)->where('role', Role::STUDENT);
        $role->delete();

        return response()->json([
            'status'  => 500,
            'message' => 'Student removed with success!',
        ]);
    }

    /**
     * Gets the Grades from a Student
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGrades($id)
    {
        $student = User::find($id);

        if ($student == null || ! $student->isStudent()) {
            return response()->json([
                'status'  => 400,
                'message' => 'The Student ID provided is not a student or not found!'
            ]);
        }

        $grades = $student->grades;

        return response()->json($grades);
    }

    /**
     * Gets enrolled Courses from a Student
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourses($id)
    {
        $student = User::find($id);

        if ($student == null || ! $student->isStudent()) {
            return response()->json([
                'status'  => 400,
                'message' => 'The Student ID provided is not a student or not found!'
            ]);
        }

        $courses = $student->courses;

        return response()->json($courses);
    }

    /**
     * Gets all Classes from a Student
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClasses($id)
    {
        $student = User::find($id);

        if ($student == null || ! $student->isStudent()) {
            return response()->json([
                'status'  => 400,
                'message' => 'The Student ID provided is not a student or not found!'
            ]);
        }

        $classes = $student->classes;

        return response()->json($classes);
    }

    /**
     * Enroll a student in a desired course
     *
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function enrollCourse(Request $request, $id = null)
    {
        $course = Course::find($request->input('course_id'));

        if ($course == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Course not found!'
            ]);
        }

        $student = User::find($id);

        if ($student == null || ! $student->isStudent()) {
            return response()->json([
                'status'  => 400,
                'message' => 'The Student ID provided is not a student or not found!'
            ]);
        }

        if ($student->courses->contains($course->id)) {
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

    /**
     * Enroll a student on a desired class
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function enrollClass(Request $request, $id)
    {
        $class = Classe::find($request->input('class_id'));

        if ($class == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Class not found!'
            ]);
        }

        $student = User::find($id);

        if ($student == null || ! $student->isStudent()) {
            return response()->json([
                'status'  => 400,
                'message' => 'The Student ID provided is not a student or not found!'
            ]);
        }

        if ($student->classes->contains($class->id)) {
            $student->classes()->detach($class->id);

            return response()->json([
                'status'  => 500,
                'message' => 'Student ' . $student->id . ' has been removed from class ' . $class->id,
            ]);
        } else {
            $student->classes()->attach($class->id);

            return response()->json([
                'status'  => 500,
                'message' => 'Student ' . $student->id . ' has added to class ' . $class->id,
            ]);
        }
    }


    /**
     * Method to test dummy stuff
     *
     * @return mixed
     */
    public function test()
    {
        $user = User::find(3);

        $f = Formatter::make($user, Formatter::XML);

        return $f->toXml();
    }
}
