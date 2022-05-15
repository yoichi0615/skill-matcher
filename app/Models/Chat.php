<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
