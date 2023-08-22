<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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



Route::get('/', [BlogController::class, 'home'])->name('blog.home');

Route::get('/blogs', [BlogController::class, 'blog'])->name('blog.blogs');

Route::get('/contact', [BlogController::class, 'contact'])->name('blog.contact');

Route::get('/about', [BlogController::class, 'about'])->name('blog.about');

Route::get('/posts/{slug}', [BlogController::class, 'showDetailPost'])->name('blog.posts.detail');

Route::get('/categories/{slug}', [BlogController::class, 'showPostsByCategory'])->name('blog.posts.category');

Route::get('/tags/{slug}', [BlogController::class, 'showPostsByTag'])->name('blog.posts.tag');

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

    // roles
    Route::get('/roles/select', [RoleController::class, 'select'])->name('roles.select');
    Route::resource('/roles', RoleController::class);

    // users
    Route::resource('/users', UserController::class)->except(['show']);

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
