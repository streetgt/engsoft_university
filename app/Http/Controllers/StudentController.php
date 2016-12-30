<?php

namespace App\Http\Controllers;

use App\Course;
use App\Discipline;
use App\Role;
use App\User;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $students = $this->user->allStudents()->get();

        return response()->json($students);
    }

    /**
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createStudent(Request $request)
    {
        $student = $this->user->create($request->all());

        $student->roles()->create([
           'role' => Role::STUDENT
        ]);

        return response()->json($student);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteStudent($id)
    {
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
     * Gets the grades from a Student
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
     * Gets enrolled courses from a Student
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
        //TODO: Adicionar middleware para verificar permissoes

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

        if ($student->courses->has($course->id)) {
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
     * Enroll a student on a desired discipline
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function enrollDiscipline(Request $request, $id)
    {
        $course = Discipline::find($request->input('discipline_id'));

        if ($course == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Discipline not found!'
            ]);
        }

        $student = User::find($id);

        if ($student == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Token is invalid!'
            ]);
        }

        if ($student->courses->has($course->id)) {
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


    public function test()
    {
        return response()->json(\App\Discipline::find(1)->classes);
    }
}
