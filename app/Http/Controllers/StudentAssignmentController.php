<?php

namespace App\Http\Controllers;

use App\Models\StudentAssignment;
use App\Http\Requests\StoreStudentAssignmentRequest;
use App\Http\Requests\UpdateStudentAssignmentRequest;
use Illuminate\Support\Facades\Storage;
class StudentAssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('studentAssigning', ['only' => ['store','show']]);
        $this->middleware('instructorAssigning', ['only' => ['update']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentAssignmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentAssignmentRequest $request)
    {
     // todo check if the student  has been assigned to this course 
     $prevAttempt= StudentAssignment::where('user_id',$request->user_id)->where('assignment_id',$request->assignment_id);

     $prevAttemptCount= $prevAttempt->count();

     if(is_null($prevAttempt->first())||$prevAttempt->first()->assignment->allowed_attempts>$prevAttemptCount ){

        $file = Storage::disk('spaces')->put('/attempts',$request->file('file'));

        return StudentAssignment::create([
              'assignment_id'=>  $request->assignment_id,
              'user_id'=>  $request->user_id,
              'attempt'=>$prevAttemptCount+1,
              'file'=>  $file,
          ]);
     }
     return response()->json([
        'message' => 'You have exceeded your attempts',
    ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentAssignment  $studentAssignment
     * @return \Illuminate\Http\Response
     */
    public function show(string $studentAssignment_id)
    {
    $assignment= StudentAssignment::findOrFail($studentAssignment_id);
    return response()->json([
        'status' => 'success',
        'assignment' => $assignment,
    ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentAssignmentRequest  $request
     * @param  \App\Models\StudentAssignment  $studentAssignment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentAssignmentRequest $request, StudentAssignment $studentAssignment)
    {
        /*
        should only allow the instructor to update the 
        grade and only the grade and does not allow any other actions 
        */
        // check if the instructor is belong to this course
        abort_if( auth()->user()->role !='instructor',response()->json('You are not supposed to be here !'));

        return $studentAssignment->update([
            'grade'=> $request->grade
        ]);

    }
}
