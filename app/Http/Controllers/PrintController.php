<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function catalog(Request $request)
    {
        $book = Book::with('deweyDecimal')->where('id', $request->query('id'))->first();
        return view('print.catalog', compact('book'));
    }
}
