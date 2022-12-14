<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject {
    use HasFactory;
    use Notifiable;

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function extended_user() {
        return $this->hasOne('App\Models\Extended_User', 'user_id', 'id');
    }

    public function followers() {
        return $this->belongsToMany(User::class, "followings", "following_id", "follower_id");
    }

    public function followings() {
        return $this->belongsToMany(User::class, "followings", "follower_id", "following_id");
    }
}
