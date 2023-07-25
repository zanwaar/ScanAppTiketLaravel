<?php

use App\Http\Livewire\Counter;
use App\Http\Livewire\Input;
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

Auth::routes(['register' => false]);

Route::get('/scan', Counter::class)->name('scan')->middleware('auth');
Route::get('/input', Input::class)->name('input')->middleware('auth');

Route::get('/download', [App\Http\Controllers\HomeController::class, 'download'])->name('download')->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('check/{id}', [UserController::class, 'show'])->name('show');
