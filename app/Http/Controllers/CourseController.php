<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

/**
 * Class CourseController
 * @package App\Http\Controllers
 */
class CourseController extends Controller
{
    /**
     * Dependency Injection Course Model
     * @var $course
     */
    protected $course;

    /**
     * StudentController constructor.
     * @param Course $course
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Display all Courses
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $courses = $this->course->all();

        return response()->json($courses);
    }

    /**
     * Display a specified Course
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourse($id)
    {
        $course = $this->course->find($id);

        return response()->json($course);
    }

    /**
     * Creates a Course
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCourse(Request $request)
    {
        $course = $this->course->create($request->all());

        return response()->json($course);
    }

    /**
     * Deletes a Course
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCourse($id)
    {
        $course = $this->course->find($id);

        if ($course == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Course not found!'
            ]);
        }

        $course->delete();

        return response()->json([
            'status'  => 500,
            'message' => 'Course removed with success!',
        ]);
    }

    /**
     * Updates a Course
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCourse(Request $request, $id)
    {
        $course = $this->course->find($id);

        if ($course == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Course not found!'
            ]);
        }

        $course->name = $request->input('name');
        $course->ects = $request->input('ects');
        $course->description = $request->input('description');
        $course->save();

        return response()->json($course);
    }

    /**
     * Displays all Disciplines associated with a Course
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourseDisciplines($id)
    {
        $course = $this->course->find($id);

        return response()->json($course->disciplines);
    }
}
