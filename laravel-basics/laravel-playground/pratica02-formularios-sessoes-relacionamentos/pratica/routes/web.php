<?php

use App\Models\{User,Reserve,Room};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('reserves.index');
});

Route::resource('hostel/users', User::class);
Route::resource('hostel/reserves', Reserve::class);
Route::resource('hostel/rooms', Room::class);