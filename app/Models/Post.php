<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

    public function upvotes()
    {
        return $this->morphMany(Upvote::class, 'upvoteable');
    }

    public function downvotes()
    {
        return $this->morphMany(Downvote::class, 'downvoteable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
