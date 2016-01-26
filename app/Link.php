<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    // A link belongs to a user

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
