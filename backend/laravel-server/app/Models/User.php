<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    use HasFactory;

    public function extended_user() {
        return $this->hasOne('App\Models\Extended_User', 'user_id', 'id');
    }
}
