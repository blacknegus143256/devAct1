<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
Route::get('/', [StudentsController::class, 'index'])->name('std.index');
Route::post('/create-student', [StudentsController::class, 'newStudent'])->name('std.create');

Route::get('/users', function () {
    $users = User::all();
    return view('users', compact('users'));
});