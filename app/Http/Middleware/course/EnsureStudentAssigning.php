<?php

namespace App\Http\Middleware\course;

use Closure;
use Illuminate\Http\Request;

class EnsureStudentAssigning
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


        // TODO : ensure the courses is active

        // make sure of the role
          if( $request->user()->role !='student')
          return response()->json(['message' =>'Unauthorized!!']);

          return $next($request);
    }
}
