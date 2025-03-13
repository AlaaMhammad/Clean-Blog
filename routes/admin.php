<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('/settings', [AdminController::class, 'settings_save']);
    // remove logo jquery
    Route::get('/delete_site_logo', [AdminController::class, 'delete_site_logo']);

    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'profile_save']);

    

    Route::get('/contact-messages', [AdminController::class, 'contact_messages'])->name('contact_messages');
    Route::get('/contact-messages/{id}', [AdminController::class, 'contact_messages_show'])->name('contact_messages.show');
    
    Route::post('/contact-messages/{id}', [AdminController::class, 'contact_messages_reply'])->name('contact_messages_reply');
    Route::delete('/contact-messages/{id}', [AdminController::class, 'contact_messages_destroy'])->name('contact_messages.destroy');


    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('posts', PostController::class);
});

