<?php

use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['prefix' => 'dash', 'middleware' => ['auth']], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/users', [AdminUserController::class, 'list']);

        Route::post('/users', [AdminUserController::class, 'add']);

        Route::get('/users/{id}', [AdminUserController::class, 'showById']);

        Route::post('/users/{id}/update', [AdminUserController::class, 'update']);

        Route::get('/users/{id}/delete', [AdminUserController::class, 'delete']);

        Route::get('/reports', [AdminReportController::class, 'list']);
    });

    Route::group(['middleware' => ['role:admin|manager|developer|client']], function () {
        // projects

        Route::get('/projects', [ProjectController::class, 'list']);

        Route::post('/projects', [ProjectController::class, 'add']);

        Route::get('/projects/add', [ProjectController::class, 'addPage']);

        Route::get('/projects/{id}', [ProjectController::class, 'edit']);

        Route::post('/projects/{id}/update', [ProjectController::class, 'update']);

        Route::get('/projects/{id}/delete', [ProjectController::class, 'delete']);

        // tasks

        Route::get('/projects/{project}/tasks', [TaskController::class, 'list']);

        Route::post('/projects/{project}/tasks', [TaskController::class, 'add']);

        Route::get('/projects/{project}/tasks/add', [TaskController::class, 'addPage']);

        Route::get('/projects/{project}/tasks/{id}', [TaskController::class, 'edit']);

        Route::post('/projects/{project}/tasks/{id}/update', [TaskController::class, 'update']);

        Route::get('/projects/{project}/tasks/{id}/delete', [TaskController::class, 'delete']);

        Route::get('/projects/{project}/tasks/{id}/stc', [TaskController::class, 'sendToCheck']);
        Route::get('/projects/{project}/tasks/{id}/ttw', [TaskController::class, 'takeToWork']);
        Route::get('/projects/{project}/tasks/{id}/sc', [TaskController::class, 'setChecked']);
        Route::get('/projects/{project}/tasks/{id}/stw', [TaskController::class, 'sendToWork']);

        Route::get('/tasks', [TaskController::class, 'developer']);
    });
});
