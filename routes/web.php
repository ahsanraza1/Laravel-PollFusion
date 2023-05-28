<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollsController;
use App\Http\Controllers\OptionsController;
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
    return redirect()->route('allpolls');
})->name('main');

Route::get('/polls',[PollsController::class, 'index'])->name('allpolls');

Route::get('/poll/create',function(){
    return view('NewPoll');
})->middleware(['auth','verified'])->name('pollForm');
Route::get('/poll/show',[PollsController::class, 'showPoll'])->middleware(['auth','verified'])->name('showpoll');

Route::post('/poll/create',[PollsController::class, 'store'])->middleware(['auth','verified'])->name('create_poll');

Route::post('/poll/castvote',[PollsController::class, 'vote'])->middleware(['auth','verified'])->name('create_vote');


Route::get('/poll/options',[OptionsController::class, 'index'])->middleware(['auth','verified'])->name('poll_options');
Route::post('/poll/options/create',[OptionsController::class, 'store'])->middleware(['auth','verified'])->name('create_poll_options');

Route::get('/dashboard', function () {
    return redirect()->route('allpolls');
    // return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
