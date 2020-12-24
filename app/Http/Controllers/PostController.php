<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
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
     * Show the create post view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $tags = Tag::get();
        return view('posts.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created post
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $validatedPost = $request->validate([
            'post_title' => ['required', 'max:255'],
            'post_body' => ['required', 'max:255'],
            'tag_id' => ['required']
        ]);

        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->post_title = $validatedPost['post_title'];
        $post->post_body = $validatedPost['post_body'];
        $post->save();
        $post->tags()->attach($validatedPost['tag_id']);

        return redirect()->route('home')->with('message', 'Post Item Was Created.');
    }

    /**
     * Show the create post view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Post $post)
    {
        $tags = Tag::get();
        return view('posts.edit', ['post' => $post, 'tags' => $tags]);
    }

     /**
     * Store a newly created post
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) 
    {
        $validatedPost = $request->validate([
            'post_title' => ['required', 'max:255'],
            'post_body' => ['required', 'max:255'],
            'post_id' => ['required'],
            'tag_id' => ['required']
        ]);

        $post = Post::find($validatedPost['post_id']);
        $post->user_id = auth()->user()->id;
        $post->post_title = $validatedPost['post_title'];
        $post->post_body = $validatedPost['post_body'];
        $post->save();
        $post->tags()->detach();
        $post->tags()->attach($validatedPost['tag_id']);

        return redirect()->route('posts.show', ['post'=>$post])->with('message', 'Post Item Was Updated.');
    }

    /**
     * Show the post selected.
     *
     * @param $id The post id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Post $post)
    {
        $postedBy = User::findOrFail($post->user_id);
        $userRoles = auth()->user()->roles;
        $isAdmin = false;
        foreach ($userRoles as $role) {
            if ($role->id == Role::where('role_type', 'Admin')->first()->id)
            {
                $isAdmin = true;
            }
        }
        $tags = $post->tags;
        return view('posts.show', ['post' => $post, 'postedBy' => $postedBy, 'tags' => $tags, 'isAdmin' => $isAdmin]);
    }

    /**
     * Delete the selected post
     * 
     * @param $id The post id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('home')->with('message', 'Post Was Deleted');
    }
}
