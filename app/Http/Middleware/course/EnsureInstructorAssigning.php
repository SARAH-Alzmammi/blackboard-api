<?php

namespace App\Http\Middleware\course;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentAssignment;
use App\Models\Chapter;
use App\Models\Assignment;
use App\Models\Course ;  
class EnsureInstructorAssigning
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

      if(isset($request->route()->parameters()['attempt'])){
        $assignment= StudentAssignment::find($request->route()->parameters()['attempt'])->assignment()->first();
        $course = Course::find(Chapter::find($assignment->chapter_id)->course_id);
      }
      if(isset($request->route()->parameters()['chapters'])){
        $course = Course::find(Chapter::find($request->route()->parameters()['chapters'])->course_id);
      }
  
      if(isset($request->route()->parameters()['courses'])){
        $course = Course::find($request->route()->parameters()['courses']);
      }
      if(isset($request->route()->parameters()['assignments'])){
        $assignment= Assignment::find($request->route()->parameters()['assignments'])->first();
        $course = Course::find(Chapter::find($assignment->chapter_id)->course_id);
  
      }
      $assigned_course= $request->user()->courses->find($course->id);

      if($assigned_course==null|| $request->user()==null)
        return response()->json(['message' =>'Unassigned!!']);

  
        // TODO : ensure the courses is active

        // make sure of the role
          if( $request->user()->role !='instructor')
          return response()->json(['message' =>'Unauthorized!!']);

          return $next($request);

     
    }
}
