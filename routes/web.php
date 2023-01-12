<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\StaffController;
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

Route::get('/', [AuthController::class, 'loginPage'])->name('home');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'registerIndex' ])->name('register.index');

Route::post('/register/student', [AuthController::class, 'registerStudent'])->name('register.student');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::middleware('auth.student')->group(function () {
        Route::get('/student', [StudentController::class, 'index'])->name('dashboard.student');
        Route::post('/student/proposal/create', [ProposalController::class, 'create'])->name('proposal.create');
        Route::patch('/student/account/editusername',[StudentController::class, 'changeUsername'])->name('student.editusername');
    });

    Route::middleware('auth.lecturer')->group(function () {
        Route::get('/lecturer',[LecturerController::class, 'index'])->name('dashboard.lecturer');
        Route::get('/lecturer/proposal/{id}', [ProposalController::class, 'detail'])->name('proposal.detail');
        Route::post('/lecturer/proposal/accdosbing', [ProposalController::class, 'accDosbing'])->name('proposal.accdosbing');
        Route::post('/lecturer/proposal/accpenguji',[ProposalController::class, 'accPenguji'])->name('proposal.accpenguji');
        Route::get('/lecturer/kaprodi/proposal/{id}', [LecturerController::class, 'kaprodiView'])->name('proposal.kaprodi');
        Route::post('/lecturer/kaprodi/proposal/acc', [ProposalController::class, 'accKaprodi'])->name('proposal.acckaprodi');
    });

    Route::middleware('auth.staff')->group(function () {
        Route::get('/staff', [StaffController::class, 'index'])->name('dashboard.staff');
        Route::get('/staff/proposal/{id}', [StaffController::class, 'plottingPenguji'])->name('plotting.staff');
        Route::post('/staff/proposal/plot/{student_user_id}/{penguji_id}', [StaffController::class, 'plot'])->name('plot');
    });

    Route::post('/proposal/submitrevision/{proposal_id}', [ProposalController::class, 'submitRevision'])->name('proposal.submitrevision');
});
