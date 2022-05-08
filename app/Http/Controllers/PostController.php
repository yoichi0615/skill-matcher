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
        $allTagNames = Tag::all()->map(function($tag) {
            return ['text' => $tag->name];
        });
        return view('post.create', compact('user', 'allTagNames'));
    }

    public function show(Request $request) 
    {
        $post = Post::find($request->id);
        return view('post.show', ['post' => $post]);
    }

    public function store(PostRequest $request, Post $post) 
    {
        $post->user_id = $request['user_id'];
        $post->summary = $request['summary'];
        if(isset($inputValues['display_flg'])) {
            $post->display_flg = $request['display_flg'];
        }
        $upload_image = $request->file('image');
        if($upload_image) {
			$path = $upload_image->store('uploads',"public");
			if($path){
                $post->image = $upload_image->getClientOriginalName();
                $post->image_path = $path;
			}
		}
        $post->description = $request['description'];
        $post->want = $request['want'];
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

    public function update(PostRequest $request) 
    {
        // dd($request);
        $postId = Auth::user()->id;
        $post = Post::find($postId);
        $params = $request->except('_token');
        $upload_image = $request->file('image');
        if($upload_image) {
			$path = $upload_image->store('uploads',"public");
            $params['image_path'] = $path;
		}
        $post->update($params);
        return redirect()->route('post.show', ['id' => $post->id]);
    }

    public function edit(Request $request, $id) {
        $post = Post::find($id);
        $tagNames = $post->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });
        
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
        return view('post.edit', compact('tagNames', 'allTagNames', 'post'));
    }
}
