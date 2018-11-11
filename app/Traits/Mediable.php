<?php

namespace App\Traits;

use App\Models\Media;

trait Mediable
{
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable')->latest();
    }

    public function getMediaCountAttribute()
    {
        return $this->media()->count();
    }
}