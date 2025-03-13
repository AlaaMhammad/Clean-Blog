<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
Route::get('/', [WebsiteController::class, 'index'])->name('website.index');
Route::get('/about', [WebsiteController::class, 'about'])->name('website.about');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('website.contact');
Route::post('/contact', [WebsiteController::class, 'contact_save']);
Route::get('/post/{post:slug}', [WebsiteController::class, 'post'])->name('website.post');

Route::get('/category/{category:slug}', [WebsiteController::class, 'category'])->name('website.category');
Route::get('/author/{user:username}', [WebsiteController::class, 'author'])->name('website.author');






//
