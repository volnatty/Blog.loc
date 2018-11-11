<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Commentable;

class Review extends Model
{
    protected $fillable = [
        'title',
        'description',
        'body',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->user_id = auth()->user()->getKey();
        });

        self::addGlobalScope('ordered', function ($builder) {
            $builder->latest('updated_at');
        });
    }
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
