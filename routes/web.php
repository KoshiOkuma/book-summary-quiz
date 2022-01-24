<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MypageController;
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
Route::get('/edit/{id}', [BookController::class, 'edit'])->name('edit');
Route::post('/update', [BookController::class, 'update'])->name('update');
Route::post('/destroy/{id}', [BookController::class, 'destroy'])->name('destroy');

Route::get('/summary/create/{id}', [SummaryController::class, 'create'])->name('summary.create');
Route::post('/summary/store', [SummaryController::class, 'store'])->name('summary.store');
Route::get('/summary/edit/{id}', [SummaryController::class, 'edit'])->name('summary.edit');
Route::post('/summary/update', [SummaryController::class, 'update'])->name('summary.update');
Route::post('/summary/destroy/{id}', [SummaryController::class, 'destroy'])->name('summary.destroy');

Route::get('/question/index', [QuestionController::class, 'index'])->name('question.index');
Route::get('/question/create/{id}', [QuestionController::class, 'create'])->name('question.create');
Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
Route::get('/question/show/{id}', [QuestionController::class, 'show'])->name('question.show');
Route::get('/answer/{id}', [QuestionController::class, 'answer'])->name('question.answer');
Route::get('/wrong_answer/{id}', [QuestionController::class, 'wrong_answer'])->name('question.wrong_answer');
Route::get('/question/edit/{id}', [QuestionController::class, 'edit'])->name('question.edit');
Route::post('/question/update', [QuestionController::class, 'update'])->name('question.update');
Route::post('/question/destroy/{id}', [QuestionController::class, 'destroy'])->name('question.destroy');

Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');
Route::post('/mypage/store', [MypageController::class, 'store'])->name('mypage.store');
Route::get('/mypage/edit/', [MypageController::class, 'edit'])->name('mypage.edit');
Route::post('/mypage/update', [MypageController::class, 'update'])->name('mypage.update');
Route::post('/mypage/restore/{id}', [MypageController::class, 'restore'])->name('mypage.restore');
Route::post('/mypage/forceDestroy/{id}', [MypageController::class, 'forceDestroy'])->name('mypage.forceDestroy');

require __DIR__.'/auth.php';
