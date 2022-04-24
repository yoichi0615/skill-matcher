<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index(Request $request) {
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            $posts = Post::where('summary', 'LIKE', '%' . $keyword . '%')->get();
        } else {
            $posts = Post::all();
        }
        return view('post.index', compact('keyword', 'posts'));
    }

    public function create() {
        $user = Auth::user();
        return view('post.create', ['user' => $user]);
    }

    public function store(Request $request, Post $post) {
        
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

        return redirect()->route('index');
    }
}
