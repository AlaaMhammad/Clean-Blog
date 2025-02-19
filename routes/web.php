<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
Route::get('/', [WebsiteController::class, 'index'])->name('website.index');
Route::get('/about', [WebsiteController::class, 'about'])->name('website.about');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('website.contact');
Route::get('/post/{id}', [WebsiteController::class, 'post'])->name('website.post');







//
