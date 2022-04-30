<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index(Request $request) 
    {
        $keyword = $request->keyword;
        $query = Post::with('user');
        if (!empty($keyword)) {
            $query = $query->where('summary', 'LIKE', '%' . $keyword . '%');
        }
        $posts = $query->orderBy('created_at', 'DESC')->get();
        return view('post.index', compact('keyword', 'posts'));
    }

    public function create() 
    {
        $user = Auth::user();
        return view('post.create', ['user' => $user]);
    }

    public function show(Request $request) 
    {
        $post = Post::find($request->id);
        return view('post.show', ['post' => $post]);
    }

    public function store(PostRequest $request, Post $post) 
    {
        $inputValues = $request->except('_token');
        $image = $request->file('image');
        if ($image) {
            $path = Storage::disk('public')->putFile('image', $image);
            $imageFileName = basename($path);
            $post->image = $imageFileName;
        } 
        $post->user_id = $request['user_id'];
        $post->summary = $request['summary'];
        if(isset($inputValues['display_flg'])) {
            $post->display_flg = $request['display_flg'];
        }
        $post->save();

        $tags = collect(json_decode($request['tags']))
        ->slice(0, 5)
        ->map(function ($requestTag) {
            return $requestTag->text;
        });

        $tags->each(function ($tagName) use ($post) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->syncWithoutDetaching($tag);
        });

        return redirect()->route('index');
    }

    public function edit(Request $request) {
        $post = Post::find($request->id);
        return view('post.edit', ['post' => $post]);
    }
}
