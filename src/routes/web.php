<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ListController;

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

Route::middleware('verified')->group(function () {
    Route::get('/', [AttendanceController::class, 'index']);
    Route::get('/workStart', [AttendanceController::class, 'workStart']);
    Route::get('/workEnd', [AttendanceController::class, 'workEnd']);
    Route::get('/breakStart', [AttendanceController::class, 'breakStart']);
    Route::get('/breakEnd', [AttendanceController::class, 'breakEnd']);

    Route::get('/attendance', [ListController::class, 'attendance']);
    Route::get('/attendance/before', [ListController::class, 'before']);
    Route::get('/attendance/after', [ListController::class, 'after']);

    Route::prefix('/users')->group(function () {
        Route::get('', [ListController::class, 'users']);
        Route::get('/attendance', [ListController::class, 'userAttendance']);
        Route::get('/attendance/before', [ListController::class, 'userBefore']);
        Route::get('/attendance/after', [ListController::class, 'userAfter']);
    });
});

require __DIR__.'/auth.php';
