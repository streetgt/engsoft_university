<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Discipline;
use App\User;
use App\Grade;
use Illuminate\Http\Request;

/**
 * Class ClassController
 * @package App\Http\Controllers
 */
class ClassController extends Controller
{
    /**
     * Dependency Injection Grade Model
     * @var $room
     */
    protected $class;

    /**
     * ClassController constructor.
     * @param Classe $class
     */
    public function __construct(Classe $class)
    {
        $this->class = $class;
    }

    /**
     * Display all Classes
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->middleware('employee');

        $class = $this->class->all();

        return response()->json($class);
    }

    /**
     * Display a specified Class
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClass($id)
    {
        $this->middleware('employee');

        $class = $this->class->find($id);

        if ($class == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Class not found!'
            ]);
        }

        return response()->json($class);
    }

    /**
     * Creates a Class
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createClass(Request $request)
    {
        $discipline = Discipline::find($request->input('discipline_id'));

        if ($discipline == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Discipline provided not found!'
            ]);
        }

        $instructor = User::find($request->input('instructor_id'));

        if ($instructor == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Instructor not found!'
            ]);
        }

        if ( ! $instructor->isInstructor()) {
            return response()->json([
                'status'  => 402,
                'message' => 'The instructor_id specified is not a instructor!'
            ]);
        }

        $class = $this->class->create($request->all());

        return response()->json($class);

    }

    /**
     * Deletes a Class
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteClass($id)
    {
        $class = $this->class->find($id);

        if ($class == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Class not found!'
            ]);
        }

        $class->delete();

        return response()->json([
            'status'  => 500,
            'message' => 'Class removed with success!',
        ]);
    }

    /**
     * Updates a Class
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateClass(Request $request, $id)
    {
        $class = $this->class->find($id);

        if ($class == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Class not found!'
            ]);
        }

        $discipline = Discipline::find($request->input('discipline_id'));

        if ($discipline == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Discipline provided not found!'
            ]);
        }

        $instructor = User::find($request->input('instructor_id'));

        if ($instructor == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Instructor not found!'
            ]);
        }

        if ( ! $instructor->isInstructor()) {
            return response()->json([
                'status'  => 402,
                'message' => 'The instructor_id specified is not a instructor!'
            ]);
        }

        $class->name = $request->input('name');
        $class->discipline_id = $request->input('discipline_id');
        $class->instructor_id = $request->input('instructor_id');
        $class->save();

        return response()->json($class);
    }
}
