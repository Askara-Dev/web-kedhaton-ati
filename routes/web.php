<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('web.layouts.master');
});

Route::get('/blogs', function () {
    return view('web.blog');
});

Route::get('/contact', function () {
    return view('web.contact');
});

Route::get('/about', function () {
    return view('web.about');
});
