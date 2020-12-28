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
     * Show the selected post view.
     *
     * @param App\Models\Post The post object to be handled.
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

    /**
     * Gets all comments for a specific post, with the user attached.
     * 
     * @param $id The post id.
     * @return App\Models\Comment
     */
    public function apiIndex($id)
    {
        $comments = Comment::where('post_id', '=', $id)->with('user')->get();
        return $comments;
    }

    /**
     * Validates and stores the created comment.
     * 
     * @param Illuminate\Http\Request The request to be handled.
     * @return \Illuminate\Http\Response
     */
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

        return response('Comment Created', 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Show the edit comment view.
     *
     * @param App\Models\Comment The comment object to be handled.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment'=> $comment]);
    }

    /**
     * Validates and updates the edited comment.
     * 
     * @param Illuminate\Http\Request The request to be handled.
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $validatedPost = $request->validate([
            'comment_body' => ['required', 'max:255'],
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
