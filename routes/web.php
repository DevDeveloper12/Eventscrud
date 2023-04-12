<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group( function(){
    // Route::resource('events','EventController');

    Route::get('/add-event', [EventController::class, 'create'])->name('add_event');
    Route::post('/create-event', [EventController::class, 'store'])->name('create_event');
    Route::delete('/delete-event/{id}', [EventController::class, 'destroy'])->name('delete_event');
    Route::get('edit-event/{id}', [EventController::class, 'edit'])->name('edit_event');
    Route::put('update-event/{id}', [EventController::class, 'update'])->name('update_event');

});
