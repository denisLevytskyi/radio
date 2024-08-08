<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsRecorder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() and $request->user()->isRecorder()) {
            return $next($request);
        } else {
            return redirect('/')->withErrors([
                'status' => 'Недостаточно прав'
            ]);
        }
    }
}
