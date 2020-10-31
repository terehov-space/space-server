<?php

use App\Http\Controllers\AdminUserController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
    Route::get('/', [AdminUserController::class, 'list']);

    Route::post('/', [AdminUserController::class, 'add']);

    Route::get('/user/{id}', [AdminUserController::class, 'showById']);

    Route::post('/user/{id}/update', [AdminUserController::class, 'update']);

    Route::post('/user/{id}/delete', [AdminUserController::class, 'delete']);

    Route::get('/reports', function () {
        return 'reports';
    });
});
