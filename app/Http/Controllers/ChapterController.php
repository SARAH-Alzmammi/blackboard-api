<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use Illuminate\Support\Facades\Storage;
class ChapterController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
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
        $file = Storage::disk('spaces')->put('/',$request->file('file'));
        return Chapter::create([
            'title'=>  $request->title,
            'course_id'=>  $request->course_id,
            'file'=>  $file,
        ]);
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
        // There is issues regarding updating
        $chapter=Chapter::find($chapter_id);
        if($request->hasFile('file')){
            dd("boo");
        }
        $chapter->update($request->all());
        // $file = Storage::disk('spaces')->put('avatars/1',$request->file('file'));
        return $chapter->update([
            'title'=>  $request->title,
            'course_id'=>  $request->course_id,
            // 'file'=>  $file,
        ]);

 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        Chapter::destroy( $chapter->id);
    }
}
