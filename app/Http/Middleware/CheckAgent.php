<?php

namespace App\Http\Middleware;

use Closure;

class CheckAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->type == 'agent')
            return $next($request);
        else
        {
            flash()->error('No access!', 'You are not an agent.');
            return redirect()->back();
        }
    }
}
