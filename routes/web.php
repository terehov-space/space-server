<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ProjectController;
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
    Route::get('/settings', [App\Http\Controllers\HomeController::class, 'index'])->name('settings');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/users', [AdminUserController::class, 'list']);

        Route::post('/users', [AdminUserController::class, 'add']);

        Route::get('/users/{id}', [AdminUserController::class, 'showById']);

        Route::post('/users/{id}/update', [AdminUserController::class, 'update']);

        Route::get('/users/{id}/delete', [AdminUserController::class, 'delete']);

        Route::get('/reports', function () {
            return 'reports';
        });
    });

    Route::group(['middleware' => ['role:admin|manager|developer|client']], function () {
        Route::get('/projects', [ProjectController::class, 'list']);

        Route::post('/projects', function() { return 'projects'; });

        Route::get('/projects/{id}', function() { return 'projects'; });

        Route::get('/projects/{id}/update', function() { return 'projects'; });

        Route::get('/projects/{id}/delete', function() { return 'projects'; });

        Route::get('/tasks', function() { return 'projects'; });

        Route::post('/tasks', function() { return 'projects'; });

        Route::get('/tasks/{id}', function() { return 'projects'; });

        Route::get('/tasks/{id}/update', function() { return 'projects'; });

        Route::get('/tasks/{id}/delete', function() { return 'projects'; });
    });
});
