<?php

use App\Exports\TemplateExport;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', [ViewController::class, 'home'])->name('home');
Route::get('/contact', [ViewController::class, 'contact'])->name('contact');
Route::get('/fetch-posts', [ViewController::class, 'fetchPosts']);
Route::get('/book', [ViewController::class, 'posts'])->name('posts');
Route::get('/book/{slug}', [ViewController::class, 'post'])->name('post');

<<<<<<< HEAD
Route::get('/about-us', function () {
    return view('about-us');
});

=======
Route::get('/download-template', function () {
    $dateTime = date('Y-m-d_H-i');
    $fileName = 'base-product_' . $dateTime . '.xlsx';
    return Excel::download(new TemplateExport, $fileName);
})->name('download-template');
>>>>>>> 949e6a0100fd4ea43c60623b66cc1d45cbe83684

Route::post('/request/book', [ViewController::class, 'requestBook'])->name('request_book');
