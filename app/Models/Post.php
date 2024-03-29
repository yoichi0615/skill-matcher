<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    Public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function tags() {
      return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function reviews() {
        return $this->hasMany(PostReview::class);
    }
}
