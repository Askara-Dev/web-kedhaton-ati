<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
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
    return view('web.home');
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

// for testing
// Route::get('/test',function() {
//     return view('welcome');
// });

Auth::routes([
    'register' => false,
]);

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    //dashboard
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');


    // categories
    Route::get('/categories/select', [CategoryController::class, 'select'])->name('categories.select');
    Route::resource('/categories', CategoryController::class);

    // tags
    Route::get('/tags/select', [TagController::class, 'select'])->name('tags.select');
    Route::resource('/tags', TagController::class)->except(['show']);

    // posts
    Route::resource('/posts', PostController::class);

    // File manager
    Route::group(['prefix' => 'filemanager'], function () {
        Route::get(
            '/index',
            [
                FileManagerController::class,
                'index'
            ]
        )->name('filemanager.index');
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
