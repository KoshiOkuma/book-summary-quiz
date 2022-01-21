<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\QuestionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [BookController::class, 'index'])->name('index');
Route::get('/create', [BookController::class, 'create'])->name('create');
Route::post('/store', [BookController::class, 'store'])->name('store');
Route::get('/show/{id}', [BookController::class, 'show'])->name('show');
Route::post('/destroy/{id}', [BookController::class, 'destroy'])->name('destroy');

Route::get('/summary/create/{id}', [SummaryController::class, 'create'])->name('summary.create');
Route::post('/summary/store', [SummaryController::class, 'store'])->name('summary.store');
Route::get('/summary/edit/{id}', [SummaryController::class, 'edit'])->name('summary.edit');
Route::post('/summary/update', [SummaryController::class, 'update'])->name('summary.update');
Route::post('/summary/destroy/{id}', [SummaryController::class, 'destroy'])->name('summary.destroy');

Route::get('/question/create/{id}', [QuestionController::class, 'create'])->name('questions.create');
Route::post('/question/store', [QuestionController::class, 'store'])->name('questions.store');
Route::get('/question/show/{id}', [QuestionController::class, 'show'])->name('questions.show');
Route::get('/answer/{id}', [QuestionController::class, 'answer'])->name('questions.answer');
Route::get('/wrong_answer/{id}', [QuestionController::class, 'wrong_answer'])->name('questions.wrong_answer');

require __DIR__.'/auth.php';
