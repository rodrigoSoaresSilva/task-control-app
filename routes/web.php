<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Mail\TestMailMessage;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('task', TaskController::class); // ->middleware('auth'); // Authentication middleware

Route::get('message-test', function(){
    return new TestMailMessage();
});
