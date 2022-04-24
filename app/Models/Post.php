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

    public function post_reviews() {
        return $this->hasMany(PostReview::class);
    }
}
