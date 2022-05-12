<?php

namespace App\Http\Controllers;

use App\Events\ChatCreated;
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
        \Log::info($request);
        $chat = Chat::create([
            'user_id' => 1,
            'body' => $request->message
        ]);

        \Log::info('fafa');
        event(new ChatCreated($chat));
    }
}
