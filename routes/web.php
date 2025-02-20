<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\StudentsController;
Route::get('/students', [StudentsController::class, 'index']);

Route::get('/users', function () {
    $users = User::all();
    return view('users', compact('users'));
});