<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'process'])->name('login-process');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('event', 'EventController');
        Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
            Route::get('{event}/participant', [EventController::class, 'participant'])->name('participant');
            Route::post('{event}/participant', [EventController::class, 'import'])->name('participant.import');
            Route::get('{event}/participant/export', [EventController::class, 'export'])->name('participant.export');
            Route::post('{event}/participant/{participant}/remove', [EventController::class, 'remove'])->name('participant.remove');
            Route::post('{event}/participant/{participant}/update', [EventController::class, 'participantUpdate'])->name('participant.update');
        });

        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
