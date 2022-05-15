<?php

namespace App\Models;

use App\Models\RoomUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    public $timestamps = true;

    protected $guarded = [
        'id',
    ];

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withTimestamps();
    }


    public function getRoom($loginUserId, $partnerId)
    {
        $roomUserRecords = RoomUser::where('user_id', $loginUserId)->get();
        if(isset($roomUserRecords)) {
            foreach($roomUserRecords as $roomUser) {
                $records = RoomUser::where('room_id', $roomUser->room_id)->get();
                foreach($records as $record) {
                    if(isset($record) && $record->user_id == $partnerId) {
                        return $record;
                    }
                }
            }
        } else {
            return false;
        }
    }
 
    public function getPartnerRoomUserById($loginUserId, $roomId) 
    {
        $ids = [$loginUserId];
        $roomUserRecords = RoomUser::where('room_id', $roomId)->get();
        if(isset($roomUserRecords)) {
            $roomUser= $roomUserRecords->whereNotIn('user_id', $ids)->first();
            $user = User::find($roomUser->user_id);
            return $user;
        } else {
            return false;
        }
    }

    public function hasRoom($userId)
    {
        if (!$userId) {
            \Log::info('0');

            return false;
        }

        if(!RoomUser::where('user_id', $userId)->exists()){
            \Log::info('1');
            return false;
        }

        \Log::info('3');

        return true;
    }
}
