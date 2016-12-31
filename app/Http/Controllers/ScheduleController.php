<?php

namespace App\Http\Controllers;

use App\User;
use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * @var
     */
    protected $schedule;

    /**
     * DI ScheduleController constructor.
     * @param Schedule $schedule
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $schedule = $this->schedule->all();

        return response()->json($schedule);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchedule($id)
    {
        $schedule = $this->schedule->find($id);

        if ($schedule == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Schedule not found!'
            ]);
        }

        return response()->json($schedule);
    }

    /**
     * Gets the schedule from a User
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserSchedule(Request $request, $id)
    {
        $sent_user = User::where('token', $request->input('token'))->first();

        $user = User::find($id);

        if ($user == null) {
            return response()->json([
                'status'  => 400,
                'message' => 'The ID provided is not a valid or not found!'
            ]);
        }

        if($sent_user->isInstructor() && $user->isStudent())
        {
            return response()->json([
                'status'  => 400,
                'message' => 'You don\'t have permission to check a student schedule!'
            ]);
        }

        $schedule = $user->schedule();

        return response()->json($schedule);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSchedule(Request $request)
    {
        $schedule = $this->schedule->create($request->all());

        return response()->json($schedule);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSchedule($id)
    {
        $schedule = $this->schedule->find($id);

        if ($schedule == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Schedule not found!'
            ]);
        }

        $schedule->delete();

        return response()->json([
            'status'  => 500,
            'message' => 'Schedule removed with success!',
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSchedule(Request $request, $id)
    {
        $schedule = $this->user->find($id);

        if ($schedule == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Schedule not found!'
            ]);
        }

        $schedule->room_id = $request->input('room_id');
        $schedule->class_id = $request->input('class_id');
        $schedule->day = $request->input('day');
        $schedule->start_hour = $request->input('start_hour');
        $schedule->duration = $request->input('duration');

        $schedule->save();

        return response()->json($schedule);
    }

}
