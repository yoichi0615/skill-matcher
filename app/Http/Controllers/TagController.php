<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($name)
    {
        $tag = Tag::where('name', $name)->first();
        return view('tags.show', ['tag' => $tag]);
    } 
}