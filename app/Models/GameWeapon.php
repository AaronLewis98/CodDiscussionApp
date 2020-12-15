<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameWeapon extends Model
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
