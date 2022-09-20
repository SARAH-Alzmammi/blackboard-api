<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;

class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChapterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChapterRequest $request)
    {
        // todo check if the instructor has been assigned to this course 
        abort_if( auth()->user()->role !='instructor',response()->json('You are not supposed to be here !'));
        return Chapter::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  string $chapter_id
     * @return \Illuminate\Http\Response
     */
    public function show(string $chapter_id)
    {
        // return chapter file & assignments
        $chapter= Chapter::findOrFail($chapter_id);
        $assignments= $chapter->assignments()->get();
      
        return response()->json([
            'status' => 'success',
            'chapter' => $chapter,
            'assignments' => $assignments,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChapterRequest  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChapterRequest $request ,$chapter_id)
    {
        $chapter=Chapter::find($chapter_id);
        $chapter->update($request->all());
        return $chapter;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        // TODO : TEST IT 
        Chapter::destroy( $chapter->id);
    }
}
