<?php

use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'home'])->name('home');
Route::get('/contact', [ViewController::class, 'contact'])->name('contact');
