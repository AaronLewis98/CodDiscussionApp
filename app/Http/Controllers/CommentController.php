<?php

namespace App\Http\Controllers;

use App\Events\PostCommented;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Post $post) 
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

    public function apiIndex($id)
    {
        $comments = Comment::where('post_id', '=', $id)->with('user')->get();
        return $comments;
    }

    public function apiStore(Request $request)
    {
        $validatedComment = $request->validate([
            'user_id' => ['required'],
            'post_id' => ['required'],
            'comment_body' => ['required', 'max:255']
        ]);

        $comment = Comment::create([
            'user_id' => $validatedComment['user_id'],
            'post_id' => $validatedComment['post_id'],
            'comment_body'=> $validatedComment['comment_body']
        ]);

        $postUserEmail = Post::find($validatedComment['post_id'])->user->email;
        $commentUserEmail = User::find($validatedComment['user_id'])->email;

        event(new PostCommented($postUserEmail, $commentUserEmail));

        return $comment;
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment'=> $comment]);
    }

    public function update(Request $request)
    {
        $validatedPost = $request->validate([
            'comment_body' => ['required', 'max:255'],
            'user_id' => ['required'],
            'post_id' => ['required'],
            'comment_id' => ['required']
        ]);

        $comment = Comment::find($validatedPost['comment_id']);
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $validatedPost['post_id'];
        $comment->comment_body = $validatedPost['comment_body'];
        $comment->save();

        return redirect()->route('posts.show', ['post'=>$comment->post_id])->with('message', 'Comment Was Updated.');
    }

}
