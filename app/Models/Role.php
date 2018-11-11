<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static $ROLES = [
        'admin' => 'Администратор',
        'author' => 'Автор',
    ];

    protected $fillable = [
        'name',
        'display',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
