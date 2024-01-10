<?php

use App\Http\Controllers\ServicesController;
use App\Http\Controllers\WorkersController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\ServiceList;
use App\Livewire\Pages\ReservationPage;

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

Route::get('/', ServiceList::class);
Route::get('/book-service/{id}', ReservationPage::class);

/** ADMIN PANEL */
Route::prefix("admin")->middleware(['auth'])->name("admin.")->group(function () {

    /** management routes */
    Route::view('dashboard', 'pages.dashboard')->name('dashboard');
    Route::view("settings", "pages.settings")->name("settings");
    Route::view('availability', 'pages.availability')->name('availability');

    /** workers management */
    Route::middleware("can:manipulate,".\App\Models\User::class)->group(function (){
        Route::get('workers', [WorkersController::class, "list"])->name('workers');
        Route::get('workers/new', [WorkersController::class, "create"])->name('workers.create');
        Route::get("workers/{id}", [WorkersController::class, "edit"])->name('workers.edit');
        Route::get("workers/delete/{id}", [WorkersController::class, "delete"])->name('workers.delete');
    });

    /** services management */
    Route::middleware("can:manipulate,".\App\Models\Service::class)->group(function (){
        Route::get('services', [ServicesController::class, "list"])->name('services');
        Route::get('services/new', [ServicesController::class, "create"])->name('services.create');
        Route::get("services/{id}", [ServicesController::class, "edit"])->name('services.edit');
        Route::get("services/delete/{id}", [ServicesController::class, "delete"])->name('services.delete');
    });


    /** personal routes */
    Route::view('profile', 'pages.profile')->middleware(['auth'])->name('profile');
});

require __DIR__ . '/auth.php';
