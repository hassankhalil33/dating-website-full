<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Extended_User;

class ApiController extends Controller {
    
    public function register(Request $request) {
        User::insert([
            "username" => $request->input("username"),
            "password" => $request->input("password"),
            "name" => $request->input("name"),
            "user_type" => "2"
        ]);

        Extended_User::insert([
            "location" => $request->input("location"),
            "gender" => $request->input("gender"),
            "interested_in" => $request->input("interested_in")
        ]);
    }
}
