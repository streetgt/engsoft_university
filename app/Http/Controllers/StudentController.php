<?php

namespace App\Http\Controllers;

use App\Course;

class StudentController extends Controller
{
    /**
     * ExampleController constructor.
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $students = Course::where('id', 9)->get();

        return response()->json($students->disciplines);
    }
}
