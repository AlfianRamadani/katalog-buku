<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
    public function home()
    {
        $cardData = [
            'img' => asset('img.jpeg'),
            'category' => 'Novel',
            'title' => 'Judul Luar Biasa',
            'description' => 'Deskripsi singkat tentang buku ini.',
        ];

        return view('home.home', compact('cardData'));
    }
    public function contact()
    {
        return view('contact.contact');
    }
}
