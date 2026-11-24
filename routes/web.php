<?php

use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Models\Application;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/authpage', [UserController::class, 'authpage'])->name('authpage');
Route::post('/auth', [UserController::class, 'auth'])->name('auth');
Route::get('/regpage', [UserController::class, 'regpage'])->name('regpage');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/logout', action: [UserController::class,'logout'])->name('logout');
Route::get('/perpage', [UserController::class, 'perpage'])->name('perpage');

Route::post('/comment/{application}', action: [CommentsController::class,'store'])->name('commentadd');
Route::get('/reservation/{room}', [UserController::class, 'reservation'])->name('reservation');



Route::post('/roomadd', action: [RoomController::class,'roomadd'])->name('roomadd');
Route::get('/roomform', [RoomController::class, 'roomform'])->name('roomform'); 

Route::get('/roomeditform/{room}', action: [RoomController::class,'roomeditform'])->name('roomeditform');
Route::post('/roomedit/{room}', action: [RoomController::class,'roomedit'])->name('roomedit');
Route::get('/delete/{room}', action: [RoomController::class,'delete'])->name('delete');


Route::post('/application/{room}', [ApplicationsController::class, 'application'])->name('application');

Route::post('/changeStatus/{application}', [ApplicationsController::class, 'changeStatus'])->name('changeStatus');

