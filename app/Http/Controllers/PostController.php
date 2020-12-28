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
     * Create a new controller instance and apply auth middleware.
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
     * Store a newly created post after validation.
     * 
     * @param \Illuminate\Http\Request The request to be handled.
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request) 
    {
        $validatedPost = $request->validate([
            'post_title' => ['required', 'max:255'],
            'post_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'post_body' => ['required', 'max:255'],
            'tag_id' => ['required']
        ]);

        $post = new Post;

        if($request->hasFile('post_image')) 
        {
            $imageName = $request->post_image->getClientOriginalName();
    
            $request->post_image->storeAs('images', $imageName, 'public');
            $post->post_image = $imageName;
        }

        $post->user_id = auth()->user()->id;
        $post->post_title = $validatedPost['post_title'];
        $post->post_body = $validatedPost['post_body'];
        $post->save();
        $post->tags()->attach($validatedPost['tag_id']);

        return redirect()->route('home')->with('message', 'Post Item Was Created.');
    }

    /**
     * Show the edit post view.
     *
     * @param App\Models\Post The post to edit.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Post $post)
    {
        $tags = Tag::get();
        return view('posts.edit', ['post' => $post, 'tags' => $tags]);
    }

     /**
     * Update the edited post providing validation succeeds.
     * 
     * @param \Illuminate\Http\Request The request to handle.
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request) 
    {
        $validatedPost = $request->validate([
            'post_title' => ['required', 'max:255'],
            'post_body' => ['required', 'max:255'],
            'post_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'post_id' => ['required'],
            'tag_id' => ['required']
        ]);

        $post = Post::find($validatedPost['post_id']);

        if($request->hasFile('post_image')) 
        {
            $imageName = $request->post_image->getClientOriginalName();
    
            $request->post_image->storeAs('images', $imageName, 'public');
            $post->post_image = $imageName;
        }

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
     * @param App\Models\Post The post to show.
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
     * Delete the selected post.
     * 
     * @param App\Models\Post The post to delete.
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('home')->with('message', 'Post Was Deleted');
    }
}
