<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        // Create a new newsletter subscription
        Newsletter::create([
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('success', 'Subscription successful!');
    }
}
