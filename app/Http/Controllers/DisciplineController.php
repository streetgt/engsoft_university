<?php

namespace App\Http\Controllers;

use App\Course;
use App\Discipline;
use Illuminate\Http\Request;

/**
 * Class DisciplineController
 * @package App\Http\Controllers
 */
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
     * Display all Disciplines
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDiscipline($id)
    {
        $discipline = $this->discipline->find($id);

        return response()->json($discipline);
    }

    /**
     * Creates a Discipline
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDiscipline(Request $request)
    {
        $discipline_info = $request->except('course_id');

        $discipline = $this->discipline->create($discipline_info);

        $found_course = $request->input('course_id');
        if ($found_course != null) {
            $course = Course::find($request->input('course_id'));

            if ($course == null) {
                return response()->json([
                    'status'  => 404,
                    'message' => 'Course ID not found!'
                ]);
            }
            $discipline->courses()->save($course);
        }

        return response()->json($discipline);
    }

    /**
     * Deletes a Discipline
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDiscipline($id)
    {
        $discipline = $this->discipline->find($id);

        if ($discipline == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Discipline not found!'
            ]);
        }

        $discipline->courses()->detach();
        $discipline->delete();

        return response()->json([
            'status'  => 200,
            'message' => 'Discipline removed with success!',
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDiscipline(Request $request, $id)
    {
        $discipline = $this->discipline->find($id);

        if ($discipline == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Discipline not found!'
            ]);
        }

        $discipline->name = $request->input('name');
        $discipline->ects = $request->input('ects');
        $discipline->save();

        return response()->json($discipline);
    }

    /**
     * Displays all Courses associated with a Discipline
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDisciplineCourses($id)
    {
        $discipline = $this->discipline->find($id);

        return response()->json($discipline->courses);
    }

    /**
     * Associates a Course to a Discipline
     *
     * @param $id_discipline
     * @param $id_course
     * @return \Illuminate\Http\JsonResponse
     */
    public function associateCourse($id_discipline, $id_course)
    {
        $discipline = $this->discipline->find($id_discipline);

        if ($discipline == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Discipline not found!'
            ]);
        }

        $course = Course::find($id_course);

        if ($course == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Course not found!'
            ]);
        }

        if($discipline->courses->contains($course->id))
        {
            return response()->json([
                'status'  => 403,
                'message' => 'Discipline ' .$discipline->id.' is already associated with Course ' . $course->id,
            ]);
        }

        $discipline->courses()->attach($course->id);

        return response()->json([
            'status'  => 200,
            'message' => 'Discipline ' . $discipline->id . ' associated with success to Course ' . $course->id,
        ]);
    }

    /**
     * Disassociates a Course from a Discipline
     *
     * @param $id_discipline
     * @param $id_course
     * @return \Illuminate\Http\JsonResponse
     */
    public function disassociateCourse($id_discipline, $id_course)
    {
        $discipline = $this->discipline->find($id_discipline);

        if ($discipline == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Discipline not found!'
            ]);
        }

        $course = Course::find($id_course);

        if ($course == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Course not found!'
            ]);
        }

        if ( ! $discipline->courses->contains($course->id)) {
            return response()->json([
                'status'  => 403,
                'message' => 'Discipline is not associated to Course ' . $course->id,
            ]);
        }

        $discipline->courses()->detach($course);

        return response()->json([
            'status'  => 200,
            'message' => 'Discipline ' . $discipline->id . ' disassociated with success from Course ' . $course->id,
        ]);
    }
}
