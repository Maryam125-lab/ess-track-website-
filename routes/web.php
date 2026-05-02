<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/tracker', function () {
    return view('tracker');
})->name('tracker');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
