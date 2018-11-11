<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function news()
    {
        return $this->belongsToMany(News::class);
    }
}
