<?php

namespace App\Http\Controllers;

use App\Room;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $rooms = $this->room->all();

        return response()->json($rooms);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoom($id)
    {
        $room = $this->room->find($id);

        return response()->json($room);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRoom(Request $request)
    {
        $room = $this->room->create($request->all());

        return response()->json($room);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoom($id)
    {
        $room = $this->room->find($id);
        $room->delete();

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
    public function updateRoom(Request $request, $id)
    {
        $room = $this->room->find($id);
        $room->number = $request->input('number');
        $room->capacity = $request->input('capacity');
        $room->save();

        return response()->json($room);
    }
}
