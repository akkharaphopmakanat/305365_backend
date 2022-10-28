<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTest;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#Route::apiResource('customer','ApiTest');
Route::post('/register', 'App\Http\Controllers\Api\RegisterController@index');
Route::post('/login', 'App\Http\Controllers\Api\RegisterController@login');
Route::get('/home', 'App\Http\Controllers\Api\CourseController@index');
Route::post('/myowncourse', 'App\Http\Controllers\Api\CourseController@myowncourse');
Route::get('/course/{courseid?}', 'App\Http\Controllers\Api\CourseController@coursedetail');
Route::get('/addcourse', 'App\Http\Controllers\Api\CourseController@addcourse');
Route::post('/delcourse/{courseid?}', 'App\Http\Controllers\Api\CourseController@delcourse');

Route::post('/enroll', 'App\Http\Controllers\Api\CourseController@activeAdd');
Route::post('/enroll_list', 'App\Http\Controllers\Api\CourseController@activeGet');
Route::post('/unenroll/{courseid?}', 'App\Http\Controllers\Api\CourseController@activeDel');

Route::post('/video_progress/{courseid?}', 'App\Http\Controllers\Api\CourseController@videoprog');
Route::post('/video_enroll_update/{courseid?}/{video_progess?}', 'App\Http\Controllers\Api\CourseController@activeUpdate');
Route::post('/enroll_complete/{courseid?}', 'App\Http\Controllers\Api\CourseController@activeComplete');