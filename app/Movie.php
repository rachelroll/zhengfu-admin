<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
