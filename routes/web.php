<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('get-user-type', function()
// {
//     dd(config('global.user_type'));
// });
Route::get('get-user-type', function()
{
    dd(config('global.pagination_records'));
});

Route::resource('todos', TodosController::class);


Route::post('/todo/store', [App\Http\Controllers\TodosController::class, 'store']);


Route::resource('student', StudentController::class);
Route::post('/student/store', [App\Http\Controllers\StudentController::class, 'store']);
Route::get('/students', [App\Http\Controllers\StudentController::class, 'index']);
Route::get('/students/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit']);
Route::post('/students/update/{id}', [App\Http\Controllers\StudentController::class, 'update']);
Route::get('/students/delete/{id}', [App\Http\Controllers\StudentController::class, 'delete']);



