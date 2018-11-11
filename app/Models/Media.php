<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    protected $fillable = [
        'mediable_type',
        'media_id',
        'path',
        'created_at',
        'updated_at',
        ];

    public function mediable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
