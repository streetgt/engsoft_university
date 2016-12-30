<?php

namespace App\Http\Controllers;

use App\Grade;

class GradeController extends Controller
{
    /**
     * Dependency Injection Grade Model
     * @var $room
     */
    protected $grade;

    /**
     * StudentController constructor.
     * @param Grade $grade
     */
    public function __construct(Grade $grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $grades = $this->grade->all();

        return response()->json($grades);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGrade($id)
    {
        $grade = $this->grade->find($id);

        if ($grade == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Grade not found!'
            ]);
        }

        return response()->json($grade);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createGrade(Request $request)
    {
        $grade = $this->grade->create($request->all());

        return response()->json($grade);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteGrade($id)
    {
        $grade = $this->grade->find($id);

        if ($grade == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Grade not found!'
            ]);
        }

        $grade->delete();

        return response()->json([
            'status'  => 500,
            'message' => 'Room removed with success!',
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateGrade(Request $request, $id)
    {
        $grade = $this->grade->find($id);

        if ($grade == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Grade not found!'
            ]);
        }

        $grade->student_id = $request->input('student_id');
        $grade->instructor_id = $request->input('instructor_id');
        $grade->discipline_id = $request->input('discipline_id');
        $grade->grade = $request->input('grade');
        $grade->date = $request->input('date');
        $grade->student_id = $request->input('description');
        $grade->save();

        return response()->json($grade);
    }
}
