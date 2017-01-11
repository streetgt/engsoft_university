<?php

namespace App\Http\Middleware;

use SoapBox\Formatter\Formatter;
use App\User;
use Closure;

/**
 * Class XmlResponseMiddleware
 * @package App\Http\Middleware
 */
class XmlResponseMiddleware
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
        $type = strtoupper($request->input('type'));
        if($type == null || $type == 'JSON')
        {
            return $next($request);
        }
        else {
            $response = $next($request);
            if($response->headers->get('content-type') == 'application/json')
            {
                $formatter = Formatter::make(json_encode($response->getData()), Formatter::JSON);
                return $formatter->toXml();
            }
        }

        return $next($request);
    }
}
