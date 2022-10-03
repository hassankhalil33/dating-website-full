<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller {
    
    function register(Request $request) {

        DB::table("users")->insert([
            "username" => $request->input("username"),
            "password" => $request->input("password"),
            "email" => $request->input("email")
        ]);
    }
}
