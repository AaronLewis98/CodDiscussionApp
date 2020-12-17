<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        return view('home', ['posts' => $posts]);
    }

    /**
     * Show the post selected.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $post = Post::findorfail($id);
        $postedBy = User::findorfail($post->user_id);
        $tags = $post->tags;
        return view('posts.show', ['post' => $post, 'postedBy' => $postedBy, 'tags' => $tags]);
    }
}
