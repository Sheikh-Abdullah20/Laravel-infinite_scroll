<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;


Route::get('/',[BlogController::class, 'index']);
Route::get('/get-blogs',[BlogController::class, 'getBlogs'])->name('get.blogs');