<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getChat()
    {
        return Chat::orderBy('id', 'desc')->get();
    }

    public function createChat(Request $request)
    {
        Chat::create([
            'user_id' => 1,
            'body' => $request->message
        ]);
    }
}
