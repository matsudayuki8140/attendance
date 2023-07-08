<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AttendanceController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [AttendanceController::class, 'index']);
    Route::get('/workStart', [AttendanceController::class, 'workStart']);
    Route::get('/workEnd', [AttendanceController::class, 'workEnd']);
    Route::get('/breakStart', [AttendanceController::class, 'breakStart']);
    Route::get('/breakEnd', [AttendanceController::class, 'breakEnd']);

    Route::get('/attendance', [AttendanceController::class, 'attendance']);
    Route::post('/attendance/before', [AttendanceController::class, 'before']);
    Route::post('/attendance/after', [AttendanceController::class, 'after']);
});

require __DIR__.'/auth.php';
