<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {

        return response()->json([
            'status' => 'success',
            'users' => User::all(),
        ]);
    }

    public function update(Request $request)
    {
        // TODO: validation
        // TODO: fix it 
        dd($request->user->id);
        $user = User::find($request->user_id);
        return  $user->update(['role'=>$request->input('role')]);

    }


}
