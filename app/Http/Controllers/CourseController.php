<?php

namespace App\Http\Controllers;

use App\Course;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $courses = $this->course->all();

        return response()->json($courses);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourse($id)
    {
        $course = $this->course->find($id);

        return response()->json($course);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCourse(Request $request)
    {
        $course = $this->course->create($request->all());

        return response()->json($course);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCourse($id)
    {
        $course = $this->course->find($id);
        $course->delete();

        return response()->json([
            'status'  => 500,
            'message' => 'Course removed with success!',
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCourse(Request $request, $id)
    {
        $course = $this->course->find($id);
        $course->name = $request->input('name');
        $course->ects = $request->input('ects');
        $course->description = $request->input('description');
        $course->save();

        return response()->json($course);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourseDisciplines($id)
    {
        $course = $this->course->find($id);

        return response()->json($course->disciplines);
    }
}
