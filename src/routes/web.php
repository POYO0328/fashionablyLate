<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
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
    Route::get('/admin', [TodoController::class, 'index']);
    Route::patch('/admin/update', [TodoController::class, 'update']);
    Route::delete('/admin/delete', [TodoController::class, 'destroy']);
    Route::get('/admin/search', [TodoController::class, 'search']);
});


Route::get('/', [ContactController::class, 'input']);

Route::post('/confirm', [ContactController::class, 'confirm']);

Route::post('/contacts', [ContactController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [TodoController::class, 'index']);
});

Route::get('/login', [TodoController::class, 'login'])->name('login');

Route::get('/todos', [TodoController::class, 'index']);

Route::delete('/delete', [ContactController::class, 'destroy']);

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
});

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');