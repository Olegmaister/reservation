<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
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
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');

Route::get('/reservation/rooms/{id}/book', [ReservationController::class, 'showBookingForm'])->name('reservation.rooms.book');
Route::post('/reservation/rooms/{id}/book', [ReservationController::class, 'book'])->name('reservation.rooms.book.store');
Route::delete('/reservation/rooms/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.rooms.cancel');

Route::resource('rooms', RoomController::class);
