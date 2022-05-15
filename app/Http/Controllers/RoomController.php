<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

//RoomControllerの処理の流れ
// ①ログインユーザーとトークしたい相手のユーザーとのトーク履歴があるかどうかを判定する。
// ②履歴がある場合は、そのままトークルームページ遷移
// ③履歴がない場合は、roomsテーブルにレコードを作成したのちにトークルームページに遷移
// ④その際にリダイレクトしたかどうかを判定するためセッションに相手と自分のルーム部屋idを保持
// ⑤ページ遷移後セッションに格納されたルームidを破棄する。


class RoomController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $session = Session::all();
        if (isset($session['room'])) {
            $targetRoom = $session['room'];
            Session::forget('room');
            return view('room.index', ['targetRoom' => $targetRoom]);
        } else {
            return view('room.index');
        }
    }

    public function create($partnerId)
    {
        \Log::info('処理①');
        $user = Auth::user();
        $loginUserId = $user->id;
        $hasRoom = $user->hasRoom($loginUserId);
        \Log::info('hasRoom');
        \Log::info($hasRoom);

        if(!$hasRoom) {
            $room = new Room();
            $hash = $loginUserId . '_' . $partnerId;
            $room->name = Hash::make($hash);
            $room->save();
            //中間テーブル(room_user)に値を挿入する。引数に配列を取ることで一気に挿入可能。
            $room->users()->attach([$loginUserId, $partnerId]);
            \Log::info('$userId');
            \Log::info($partnerId);

            response()->json($partnerId);
        }
    }

    public function redirectRoom($userId, $partnerId)
    {
        $user = Auth::user();
        $room = $user->getRoom($userId, $partnerId);
        // リダイレクトでsessionに渡している。withだとうまくいかなかった。
        Session::put('room', $room);
        return redirect()->route('chat_room_list', ['user_id' => $userId]);
    }

    public function getChatRoom($loginUserId, $roomId)
    {
        $roomPartnerUser = $loginUserId->getPartnerRoomUserById($loginUserId, $roomId);
        return $roomPartnerUser;
    }

    public function getRoomList($loginUserId)
    {
        \Log::info('loginuserId');
        \Log::info($loginUserId);
        $loginUser = User::find($loginUserId);
        $rooms = $loginUser->rooms()->get();
        foreach ($rooms as $room) {
            $ids = [$loginUserId];
            $roomUser = $room->users()->whereNotIn('user_id', $ids)->first();
            $room->user = $roomUser;
            $roomLastMessage = $room->chats()->latest()->first();
            $room->last_message = $roomLastMessage;
        }
        return $rooms;
    }
}


