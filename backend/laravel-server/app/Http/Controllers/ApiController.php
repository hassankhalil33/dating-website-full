<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Extended_User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller {
    
    public function register(Request $request) {
        $newUser = new User;
        $extendedUser = new Extended_User;

        $newUser->username = $request->input("username");
        $newUser->password = bcrypt($request->input("password"));
        $newUser->name = $request->input("name");
        $newUser->user_type = "2";
        $newUser->save();

        $extendedUser->location = $request->input("location");
        $extendedUser->gender = $request->input("gender");
        $extendedUser->biography = "";
        $extendedUser->interested_in = $request->input("interested_in");
        $newUser->extended_user()->save($extendedUser);

        return response()->json([
            "status" => "success",
            "message" => "registered successfully"
        ]);
    }

    public function feed() {
        $feed = Extended_User::
            where([
                ['user_id', '=', Auth::id()],
                ['gender', '=', 'interested_in']
            ])
            ->with("User")
            ->get();

        return response()->json([
            "status" => "success",
            "message" => $feed
        ]);
    }
}
