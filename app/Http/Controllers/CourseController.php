<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\DB;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // todo return all chapters and assignments related to the course
        $user_id =  auth()->user()->id;

        if(auth()->user()->role == 'admin')
        $courses = Course::all();

        else
        $courses=  DB::table('course_user')
        ->join('users','users.id','=','course_user.user_id') 
        // TODO: make sure the course is active
        ->join('courses','courses.id','=','course_user.course_id') 
        ->select('courses.*')->where('users.id','=', $user_id )->get();

        return response()->json([
            'status' => 'success',
            'courses' => $courses,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        abort_if( auth()->user()->role !='admin',response()->json('You are not supposed to be here !'));
        return Course::create($request->all());
    }


    public function show($course_id)
    {
        return Course::findOrFail($course_id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request,$course_id)
    {
        $course=Course::find($course_id);
        $course->update($request->all());
        return $course;
;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        Course::destroy( $course->id);
    }
}
