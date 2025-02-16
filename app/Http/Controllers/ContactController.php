<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'ip_address' => $request->ip(), // Simpan IP pengirim
        ]);

        return redirect()->route('home')->with('success', 'Pesan Anda telah dikirim dan disimpan di database!');
    }
}
