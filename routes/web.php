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

Route::view('/', 'livewire/pages/service-list');

/** ADMIN PANEL */
Route::prefix("admin")->middleware(['auth'])->name("admin.")->group(function () {

    /** management routes */
    Route::view('dashboard', 'pages.dashboard')->name('dashboard');
    Route::view('workers', 'pages.workers')->name('workers');
    Route::view("workers/{id}", 'pages.workers.edit')->name('workers.edit');

    /** personal routes */
    Route::view('profile', 'pages.profile')->middleware(['auth'])->name('profile');
});

require __DIR__ . '/auth.php';
