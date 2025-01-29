<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Illuminate\Support\Str;

class ViewController extends Controller
{
    public function home(Request $request)
    {
        // $cardData = [
        //     'img' => asset('img.jpeg'),
        //     'category' => 'Novel',
        //     'title' => 'Judul Luar Biasa',
        //     'description' => 'Deskripsi singkat tentang buku ini.',
        // ];
        $book = Book::orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::get();
        if ($request->ajax()) {
            return response()->json([
                'posts' => $book->items(), // Data
                'nextPage' => $book->currentPage() < $book->lastPage() ? $book->currentPage() + 1 : null, // Halaman berikutnya
            ]);
        }

        return view('home.home', compact('book', 'categories'));
    }
    public function contact()
    {
        return view('contact.contact');
    }
    public function requestBook()
    {
        return view('request');
    }
    public function fetchPosts(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 10;

        // Ambil data berdasarkan page yang diminta
        $book = Book::paginate($perPage, ['*'], 'page', $page);

        // Memeriksa apakah request AJAX
        return response()->json([
            'posts' => $book->items(), // Kirim data post
            'nextPage' => $book->currentPage() < $book->lastPage() ? $book->currentPage() + 1 : null, // Halaman berikutnya
        ]);
    }
    public function posts(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('search');
        if (!$category && !$search) {
            return redirect()->route('home');
        }
        $book = Book::whereHas('category', function ($query) use ($category) {
            $query->where('name', $category);
        })
            ->where('title', 'like', "%$search%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('book_search', compact('book', 'category', 'search'));
    }
    public function post(String $slug)
    {
        $unslug = Str::replace('-', ' ', $slug);
        $book = Book::where('title', $unslug . '.')->first();
        return view('detail_book', compact('book'));
    }
}
