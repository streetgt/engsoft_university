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

    public function index()
    {
        $courses = $this->course->with('disciplines')->get();

        return response()->json($courses);
    }
}
