<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function movie()
    {
        return $this->hasMany(Movie::class);
    }
}
