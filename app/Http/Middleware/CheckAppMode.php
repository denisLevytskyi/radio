<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Prop;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAppMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct (public Prop $prop) {}

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() and ((int) $this->prop->getProp('app_mode') or $request->user()->isAdministrator())) {
            return $next($request);
        } else {
            return redirect('/')->withErrors([
                'status' => 'Недостаточно прав'
            ]);
        }
    }
}
