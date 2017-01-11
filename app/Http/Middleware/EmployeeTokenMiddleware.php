<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

/**
 * Class EmployeeTokenMiddleware
 * @package App\Http\Middleware
 */
class EmployeeTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle($request, Closure $next)
    {
        /**
         * @todo: apagar a seguinte linha para testar os tokens
         */
        return $next($request);

        $token = $request->input('token');
        $user = User::where('token', $token)->first();

        if ($user->isEmployee()) {
            return $next($request);
        }

        return response()->json([
            'status'  => '401',
            'message' => 'Unauthorized access! Your token is invalid for the request you are trying to do!',
        ]);
    }

}
