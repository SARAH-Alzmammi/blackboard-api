<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\StudentAssignmentController;
use App\Http\Controllers\admin\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::resource('courses', CourseController::class);
Route::resource('chapters', ChapterController::class);
Route::resource('assignments', AssignmentController::class);
Route::resource('assignments/attempt', StudentAssignmentController::class);
Route::resource('admin/users/', UserController::class);
