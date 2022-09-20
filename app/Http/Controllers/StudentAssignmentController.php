<?php

namespace App\Http\Controllers;

use App\Models\StudentAssignment;
use App\Http\Requests\StoreStudentAssignmentRequest;
use App\Http\Requests\UpdateStudentAssignmentRequest;

class StudentAssignmentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentAssignmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentAssignmentRequest $request)
    {
               // todo check if the student  has been assigned to this course 
            //    abort_if( auth()->user()->role !='student',response()->json('You are not supposed to be here !'));
               return StudentAssignment::create($request->all());
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
        // only the instructor can update only the grade 
dd($request->grade);
        // $studentAssignment->update($request->all());
        // return $studentAssignment;
    }
}
