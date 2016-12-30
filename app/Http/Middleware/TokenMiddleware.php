<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class TokenMiddleware
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
        // TODO: ligar token

        return $next($request);
        $token = $request->input('token');
        if ($token == null) {
            return response()->json([
                'status'  => '500',
                'message' => 'Unauthorized access without a token!',
            ]);
        }

        $user = User::where('token', $token)->first();
        if ($user == null) {
            return response()->json([
                'status'  => '400',
                'message' => 'Invalid token!',
            ]);
        }

        return $next($request);
    }
}
