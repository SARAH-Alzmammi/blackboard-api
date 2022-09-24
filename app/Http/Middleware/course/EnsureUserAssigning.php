<?php

namespace App\Http\Middleware\course;

use Closure;
use Illuminate\Http\Request;

class EnsureUserAssigning
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $is_assigned = $request->user()->courses->find($request->route()->parameters('courses'));

        if(!$is_assigned ->isNotEmpty())
          return response()->json(['message' =>'Unassigned!!']);


        return $next($request);
    }
}
