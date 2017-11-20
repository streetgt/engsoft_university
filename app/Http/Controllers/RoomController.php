<?php

namespace App\Http\Controllers;

use App\Room;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class RoomController
 * @package App\Http\Controllers
 */
class RoomController extends Controller
{
    /**
     * Dependency Injection Room Model
     * @var $room
     */
    protected $room;

    /**
     * StudentController constructor.
     * @param Room $room
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    /**
     * Display all Rooms
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $rooms = $this->room->all();

        return response()->json($rooms);
    }

    /**
     * Display a Room
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoom($id)
    {
        $room = $this->room->find($id);

        if ($room == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Room not found!'
            ]);
        }

        return response()->json($room);
    }

    /**
     * Creates a Room
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRoom(Request $request)
    {
        $room = $this->room->create($request->all());

        return response()->json($room);
    }

    /**
     * Deletes a Room
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoom($id)
    {
        $room = $this->room->find($id);

        if ($room == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Room not found!'
            ]);
        }

        $room->delete();

        return response()->json([
            'status'  => 200,
            'message' => 'Room removed with success!',
        ]);
    }

    /**
     * Updates a Room
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRoom(Request $request, $id)
    {
        $room = $this->room->find($id);

        if ($room == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Room not found!'
            ]);
        }

        $room->number = $request->input('number');
        $room->capacity = $request->input('capacity');
        $room->save();

        return response()->json($room);
    }

    /**
     * Displays information about a Room based on Schedule
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoomOccupiedInformation($id)
    {
        $room = $this->room->find($id);

        if ($room == null) {
            return response()->json([
                'status'  => 404,
                'message' => 'Room not found!'
            ]);
        }

        $schedule = Schedule::with('room', 'classe')->where('room_id', $room->id)->get();

        return response()->json($schedule);
    }

    /**
     * Get a list of free rooms at current hour
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoomsFree()
    {
        $current_occupied = Schedule::where('start_hour', '>=', Carbon::now()->hour)
            ->where('start_hour', '<=', Carbon::now()->hour + 'duration')
            ->pluck('room_id');

        $rooms = Room::whereNotIn('id', $current_occupied)->get();

        return response()->json($rooms);
    }
}
