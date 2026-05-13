<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // 📩 user يرسل message
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Message::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'message' => $request->message,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Message envoyé avec succès');
    }

    // 👨‍💼 admin يشوف messages
    public function index()
    {
        $messages = Message::latest()->get();
        return view('admin.messages', compact('messages'));
    }
}