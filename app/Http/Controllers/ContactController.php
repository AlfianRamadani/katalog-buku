<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        if (RateLimiter::tooManyAttempts('contactUs:' . optional($request->user())->id ?: $request->ip(), 5)) {
            return redirect()->back()->with('alert', 'Telah mencapai batas maksimal request hari ini. Silakan coba lagi besok.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
        try {
            ContactUs::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'ip_address' => $request->ip(), // Simpan IP pengirim
            ]);
            RateLimiter::hit('contactUs:' . optional($request->user())->id ?: $request->ip());
            return redirect()->back()->with('alert', 'Pesan Anda telah dikirim dan akan segera di terima oleh admin!');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('alert', 'Terjadi kesalahan, silahkan coba lagi.');
        }
    }
}
