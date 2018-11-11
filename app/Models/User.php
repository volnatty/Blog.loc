<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getUserAvatarAttribute()
    {
        $avatar = 'images/no-avatar-300x300.png';

        if ($this->avatar) {
             $avatar = $this->avatar;
        }

        return asset($avatar);
    }

    public function hasRole($needle)
    {
        if (is_array($needle)) {
            return in_array(Auth::user()->role->name, $needle);
        }

        return Auth::user()->role->name === $needle;
    }
}
