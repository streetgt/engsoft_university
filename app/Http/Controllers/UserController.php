<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var
     */
    protected $user;

    /**
     * StudentController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $students = $this->user->all();

        return response()->json($students);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser($id)
    {

        $user = $this->user->find($id);

        return response()->json($user);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request)
    {
        $user = $this->user->create($request->all());

        return response()->json($user);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser($id)
    {
        $user = $this->user->find($id);

        $user->delete();

        return response()->json([
            'status'  => 500,
            'message' => 'User removed with success!',
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request, $id)
    {
        $user = $this->user->find($id);

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->ssn = $request->input('ssn');
        $user->birthdate = $request->input('birthdate');
        $user->gender = $request->input('gender');

        $user->save();

        return response()->json($user);
    }

}
