<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\StudentsController;
Route::get('/students', [StudentsController::class, 'index']);
