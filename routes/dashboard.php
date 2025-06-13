<?php

use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\LanguagesController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SoundsController;
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

Route::get('' , function () {
    return view('dashboard.index');
})->name('index');

Route::get('' , HomeController::class)->name('index');
// Languages Routes
Route::resource('languages' , LanguagesController::class);

// Sounds Routes
Route::get('sounds/{id}' , [SoundsController::class, 'edit'])->name('sounds.edit');
Route::put('sounds/{id}' , [SoundsController::class, 'update'])->name('sounds.update');
Route::delete('sounds/{id}' , [SoundsController::class, 'destroy'])->name('sounds.destroy');

// Admins Routes
Route::resource('admins' , AdminsController::class);

//Profile Routes
Route::get('logout' , [ProfileController::class, 'logout'])->name('logout');
Route::post('update-password' , [ProfileController::class, 'updatePassword'])->name('password.update');