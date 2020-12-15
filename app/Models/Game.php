<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    public function gameModes()
    {
        return $this->morphedByMany(GameMode::class, 'gameable');    
    }

    public function gameWeapons()
    {
        return $this->morphedByMany(GameWeapon::class, 'gameable');    
    }

    public function tag()
    {
        return $this->morphOne(Tag::class, 'taggable');
    }
}
