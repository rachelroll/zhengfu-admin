<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $dates = [
        'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
