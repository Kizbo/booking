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
    Route::view("settings", "pages.settings")->name("settings");

    /** workers management */
    Route::view('workers', 'pages.workers')->name('workers');
    Route::view('workers/new', 'pages.workers.create')->name('workers.create');
    Route::view("workers/{id}", 'pages.workers.edit')->name('workers.edit');

    /** services management */
    Route::view('services', 'pages.services')->name('services');
    Route::view('services/new', 'pages.services.create')->name('services.create');
    Route::view("services/{id}", 'pages.services.edit')->name('services.edit');

    /** personal routes */
    Route::view('profile', 'pages.profile')->middleware(['auth'])->name('profile');
});

require __DIR__ . '/auth.php';
