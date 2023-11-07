<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('job/users/{job}', [RecruiterController::class, 'users'])->name('job.users');
    Route::get('job/user/{user}', [RecruiterController::class, 'user'])->name('job.user');
    Route::get('job/user/{candidate_job}/{user}', [RecruiterController::class, 'user'])->name('job.user');
    Route::resource('job', RecruiterController::class);

    Route::get('/candidate/jobs', [CandidateController::class, 'jobs'])->name('candidate.jobs');
    Route::get('/candidate/jobs/applied', [CandidateController::class, 'jobsApplied'])->name('candidate.applied');
    Route::post('/candidate/job/apply', [CandidateController::class, 'applyJob'])->name('candidate.apply');
    Route::get('/candidate/jobs/{id}', [CandidateController::class, 'job'])->name('candidate.job');
});

require __DIR__.'/auth.php';
