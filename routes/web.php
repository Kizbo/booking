<?php

use App\Http\Controllers\WorkersController;
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
    Route::get('workers', [WorkersController::class, "list"])->can("manipulate", \App\Models\User::class)->name('workers');
    Route::get('workers/new', [WorkersController::class, "create"])->name('workers.create');
    Route::get("workers/{id}", [WorkersController::class, "edit"])->name('workers.edit');

    /** services management */
    Route::view('services', 'pages.services')->name('services');
    Route::view('services/new', 'pages.services.create')->name('services.create');
    Route::view("services/{id}", 'pages.services.edit')->name('services.edit');

    /** personal routes */
    Route::view('profile', 'pages.profile')->middleware(['auth'])->name('profile');
});

require __DIR__ . '/auth.php';
