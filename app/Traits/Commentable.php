<?php

namespace App\Traits;

use App\Models\Comment;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments()->whereApproved(true)->count();
    }
}
