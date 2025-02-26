<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('posts', PostController::class);
});

