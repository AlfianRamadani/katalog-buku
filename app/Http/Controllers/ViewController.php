<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\HistoryLoanBook;
use App\Models\RequestBook;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
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
        $book = Book::with('review')->orderBy('created_at', 'desc')->paginate(10)->through(function ($item) {
            $item->rate = $item->review->avg('rate') ?? 0;
            return $item;
        });
        $book->makeHidden('review');
        $categories = Category::get();


        return view('home.home', compact('book', 'categories'));
    }
    public function contact()
    {
        return view('contact.contact');
    }

    public function fetchPosts(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 10;

        // Ambil data berdasarkan page yang diminta
        $book = Book::with('review', 'category')->inRandomOrder()->paginate($perPage, ['*'], 'page', $page)->through(function ($item) {
            $item->rate = $item->review->avg('rate') ?? 0;
            return $item;
        });

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

        // Mulai query untuk Book
        $bookQuery = Book::query();

        // Filter berdasarkan kategori jika ada
        if ($category) {
            $bookQuery->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        // Filter berdasarkan pencarian jika ada
        if ($search) {
            $bookQuery->where('title', 'like', "%$search%");
        }

        // Ambil hasil dengan pagination
        $book = $bookQuery->orderBy('created_at', 'desc')
            ->paginate(10)
            ->through(function ($item) {
                $item->rate = $item->review->avg('rate') ?? 0;
                return $item;
            });

        return view('book_search', compact('book', 'category', 'search'));
    }

    public function post(String $slug)
    {
        $book = Book::where('slug', $slug)->first();
        if (!$book) {
            return view('404')->with('slug', $slug);
        }
        $book->rate = $book->review->avg('rate') ?? 0;
        $book->makeHidden('review');
        $reviews = Review::where('book_id', $book->id)->paginate(3);
        return view('detail_book', compact('book', 'reviews'));
    }
    public function requestBook(Request $request)
    {
        if (RateLimiter::tooManyAttempts('requestBook:' . optional($request->user())->id ?: $request->ip(), 5)) {
            return redirect()->back()->with('alert', 'Telah mencapai batas maksimal request hari ini. Silakan coba lagi besok.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);
        try {
            RequestBook::create([
                'name' => $validatedData['name'],
                'ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);
            RateLimiter::hit('requestBook:' . optional($request->user())->id ?: $request->ip());
            return redirect()->back()->with('alert', 'Terimakasih telah mebmberikan saran buku kepada kami, kami berharap dapat menyediakan buku yang anda inginkan. Terimakasih..');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('alert', 'Terjadi kesalahan, silahkan coba lagi.');
        }
    }
}
