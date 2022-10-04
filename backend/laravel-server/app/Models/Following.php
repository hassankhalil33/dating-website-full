<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model {
    use HasFactory;

    public function followers() {
        return this->belongsToMany(User::class, "followings", "following_id", "follower_id");
    }

    public function followings() {
        return this->belongsToMany(User::class, "followings", "follower_id", "following_id");
    }
}
