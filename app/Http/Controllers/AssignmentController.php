<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;

class AssignmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssignmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignmentRequest $request)
    {
        // todo check if the instructor has been assigned to this course 
        abort_if( auth()->user()->role !='instructor',response()->json('You are not supposed to be here !'));
        return Assignment::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
             $assignment= Assignment::findOrFail($assignment->id);
             return response()->json([
                 'status' => 'success',
                 'assignment' => $assignment,
             ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssignmentRequest  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        // does not work properly
        // $chapter=Chapter::find($chapter_id);
        $assignment->update($request->all());
        return $assignment;
    //   dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
            // TODO : secure it 
            Assignment::destroy( $assignment->id);
    }
}
