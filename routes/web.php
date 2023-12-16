<?php

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

Route::view('/', 'welcome');

/** ADMIN PANEL */
Route::prefix("admin")->middleware(['auth', 'verified'])->name("admin.")->group(function (){

    /** management routes */
    Route::view('dashboard', 'dashboard')->name('dashboard');

    /** personal routes */
    Route::view('profile', 'profile')->middleware(['auth'])->name('profile');


});

require __DIR__.'/auth.php';
