<?php

namespace App\Http\Controllers;

use App\Discipline;

class DisciplineController extends Controller
{
    /**
     * Dependency Injection Course Model
     * @var $course
     */
    protected $discipline;

    /**
     * DisciplineController constructor.
     * @param Discipline $discipline
     */
    public function __construct(Discipline $discipline)
    {
        $this->discipline = $discipline;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $disciplines = $this->discipline->with('courses')->get();

        return response()->json($disciplines);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDiscipline($id)
    {
        $discipline = $this->discipline->find($id);

        return response()->json($discipline);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDisciplineCourses($id)
    {
        $discipline = $this->discipline->find($id);

        return response()->json($discipline->courses);
    }
}
