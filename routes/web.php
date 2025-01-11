<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Mail\TestMailMessage;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('task/export/{extension}', [TaskController::class, 'export'])->name('task.export');
Route::resource('task', TaskController::class)->middleware('verified'); // ->middleware('auth'); // Authentication middleware

Route::get('message-test', function () {
    return new TestMailMessage();
});
