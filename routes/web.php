<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/register/trial', function () {
    return view('trial');
})->name('trial');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/features', function () {
    return view('features');
})->name('features');

Route::get('/api/docs', function () {
    return view('docs');
})->name('docs');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/api/docs/reference', function () {
    return view('reference');
})->name('reference');
