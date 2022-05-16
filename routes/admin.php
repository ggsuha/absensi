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

Route::name('admin.')->group(function(){
    Route::middleware('guest')->group(function() {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'process'])->name('login-process');
    });

    Route::middleware('auth')->group(function() {
        Route::get('/', function() {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
            Route::get('/', [EventController::class, 'index'])->name('index');
            Route::get('/create', [EventController::class, 'create'])->name('create');
            Route::post('/create', [EventController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'project', 'as' => 'project.'], function () {
            Route::get('/', [ProjectController::class, 'index'])->name('index');
            Route::get('/create', [ProjectController::class, 'create'])->name('create');
        });

        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});