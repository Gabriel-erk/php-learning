<?php

use App\Http\Controllers\{ReserveController, RoomController, UserController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('users.index');
});

Route::resource('hostel/users', UserController::class);
Route::resource('hostel/reserves', ReserveController::class);
Route::resource('hostel/rooms', RoomController::class);