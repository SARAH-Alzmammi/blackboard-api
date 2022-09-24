<?php

namespace App\Http\Middleware\course;

use Closure;
use Illuminate\Http\Request;
use App\Models\StudentAssignment;
use App\Models\Chapter;
use App\Models\Assignment;
use App\Models\Course    
;
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


    if(isset($request->route()->parameters()['attempt'])){
      $assignment= StudentAssignment::find($request->route()->parameters()['attempt'])->assignment()->first();
      $course = Course::find(Chapter::find($assignment->chapter_id)->course_id);
    }
    else if(isset($request->route()->parameters()['chapters'])){
      $course = Course::find(Chapter::find($request->route()->parameters()['chapters'])->course_id);
    }

    else if(isset($request->route()->parameters()['courses'])){
      $course = Course::find($request->route()->parameters()['courses']);
    }
    else if(isset($request->route()->parameters()['assignments'])){
      $assignment= Assignment::find($request->route()->parameters()['assignments'])->first();
      $course = Course::find(Chapter::find($assignment->chapter_id)->course_id);

    }else{
    // incase none of them applied it means it got a body either with  course_id or assignment_id.
    $assignment= Assignment::find($request->assignment_id);
    if(isset($assignment))
      $course = Course::find(Chapter::find($assignment->first()->chapter_id)->course_id);
      else
      $course = Course::find($request->course_id);
    }



        $course_id = $course->id??3;
        $assigned_course= $request->user()->courses->find($course_id);

        if($assigned_course==null|| $request->user()==null)
          return response()->json(['message' =>'Unassigned!!']);


        // TODO : ensure the courses is active

        // making sure of the role
          // if( $request->user()->role !='student')
          // return response()->json(['message' =>'Unauthorized!!']);

          return $next($request);
    }
}
