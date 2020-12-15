<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameMode extends Model
{

    public function games()
    {
        return $this->morphToMany(Game::class, 'gameable');    
    }

    public function tag()
    {
        return $this->morphOne(Tag::class, 'taggable');
    }
}
