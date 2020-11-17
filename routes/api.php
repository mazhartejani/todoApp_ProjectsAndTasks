<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
//use App\Http\Controllers\TaskController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource("projects", ProjectController::class);
Route::get("/tasks/{Project_id}", 'TaskController@index');
Route::post("/tasks", 'TaskController@store');
Route::put("/tasks/{task_id}", 'TaskController@isCompleted');
Route::delete("/tasks/{task_id}", 'TaskController@destroy');


