<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Downvote extends Model
{

    public function downvoteable()
    {
        return $this->morphTo();
    }
}
