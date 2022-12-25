<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\StudentController;
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

Route::get('/', [AuthController::class, 'loginPage']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::middleware('auth.student')->group(function () {
        Route::get('/student', [StudentController::class, 'index'])->name('dashboard.student');
        Route::post('/student/proposal/create', [ProposalController::class, 'create'])->name('proposal.create');
    });

    Route::middleware('auth.lecturer')->group(function () {
        Route::get('/lecturer', function () {
            return view('lecturer.dashboard');
        })->name('dashboard.lecturer');
    });
});
