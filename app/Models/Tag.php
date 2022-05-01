<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = ['id'];
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function getHashTagAttribute()
    {
        return '#' . $this->name;
    }
}
