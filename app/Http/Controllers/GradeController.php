<?php

namespace App\Http\Controllers;

use App\Classe;
use App\User;
use App\Grade;
use Illuminate\Http\Request;

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
        $this->middleware('employee');

        $grades = $this->grade->all();

        return response()->json($grades);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGrade($id)
    {
        $this->middleware('employee');

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
        $sent_user = User::where('token', $request->input('token'))->first();

        if ($sent_user->isEmployee()) {
            $grade = $this->grade->create($request->all());
        } else {
            if ($sent_user->id != $request->input('instructor_id')) {
                return response()->json([
                    'status'  => 402,
                    'message' => 'As a instructor you can\'t access another teacher grade!',
                ]);
            }
            //
            $instructor_classes = $sent_user->classes;
            $disciplines_instructor = [];
            foreach ($instructor_classes as $class) {
                $disciplines_instructor[] = $class->discipline_id;
            }

            if ( ! in_array($request->input('discipline_id'), $disciplines_instructor)) {
                return response()->json([
                    'status'  => 402,
                    'message' => 'You are not authorized to post other disciplines grades!'
                ]);
            }

            $user = User::find($request->input('student_id'));

            if ( ! $user->isStudent()) {
                return response()->json([
                    'status'  => 402,
                    'message' => 'The student_id specified is not a student!'
                ]);
            }

            $user_classes = $user->classes;
            $disciplines_user = [];
            foreach ($user_classes as $class) {
                $disciplines_user[] = $class->discipline_id;
            }

            if ( ! in_array($request->input('discipline_id'), $disciplines_user)) {
                return response()->json([
                    'status'  => 402,
                    'message' => 'The student provided is not registed at discipline ' . $request->input('discipline_id'),
                ]);
            }

            $grade = $this->grade->create($request->all());

        }

        return response()->json($grade);
    }

    /**
     * Deletes a grade
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteGrade(Request $request, $id)
    {
        $sent_user = User::where('token', $request->input('token'))->first();

        $grade = $this->grade->find($id);

        if ($grade == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Grade not found!'
            ]);
        }

        if ($sent_user->isEmployee()) {
            $grade->delete();
        } else {
            if ($sent_user->id != $grade->instructor_id) {
                return response()->json([
                    'status'  => 402,
                    'message' => 'You can only delete your registered grades!',
                ]);
            }

            $grade->delete();

        }

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
        $sent_user = User::where('token', $request->input('token'))->first();

        $grade = $this->grade->find($id);

        if ($grade == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Grade not found!'
            ]);
        }

        if ($sent_user->isEmployee()) {
            $grade->student_id = $request->input('student_id');
            $grade->instructor_id = $request->input('instructor_id');
            $grade->discipline_id = $request->input('discipline_id');
            $grade->grade = $request->input('grade');
            $grade->date = $request->input('date');
            $grade->student_id = $request->input('description');
            $grade->save();
        } else {
            if ($sent_user->id != $grade->instructor_id) {
                return response()->json([
                    'status'  => 402,
                    'message' => 'You can only update your registered grades!',
                ]);
            }

            $grade->student_id = $request->input('student_id');
            $grade->instructor_id = $request->input('instructor_id');
            $grade->discipline_id = $request->input('discipline_id');
            $grade->grade = $request->input('grade');
            $grade->date = $request->input('date');
            $grade->student_id = $request->input('description');
            $grade->save();
        }

        return response()->json($grade);
    }
}
