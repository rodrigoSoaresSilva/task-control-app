<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Mail\TestMailMessage;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('task/export-excel/{extension}', [TaskController::class, 'exportExcel'])->name('task.export-excel');
Route::get('task/export-pdf', [TaskController::class, 'exportPDF'])->name('task.export-pdf');
Route::resource('task', TaskController::class)->middleware('verified'); // ->middleware('auth'); // Authentication middleware

Route::get('message-test', function () {
    return new TestMailMessage();
});
