<?php

namespace App\Http\Controllers;

use App\Events\ChatCreated;
use App\Models\Chat;
use App\Models\Room;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function getChat()
    {
        return Chat::orderBy('id', 'desc')->get();
    }

    public function getAllChat($roomId)
    {
        return Room::find($roomId)->chats()->get();
    }

    public function createChat(Request $request)
    {
        \Log::info($request);
        $chat = Chat::create([
            'user_id' => $request->userId,
            //後で修正
            'room_id' => 1,
            'body' => $request->message
        ]);

        \Log::info('fafa');
        event(new ChatCreated($chat));
    }

    
}
