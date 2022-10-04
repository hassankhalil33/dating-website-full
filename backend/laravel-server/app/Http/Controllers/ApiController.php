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
        $extendedUser->age = $request->input("age");
        $extendedUser->interested_in = $request->input("interested_in");
        $newUser->extended_user()->save($extendedUser);

        return response()->json([
            "status" => "success",
            "message" => "registered successfully"
        ]);
    }

    public function feed() {
        $interestedIn = Extended_User::
            where("user_id", Auth::id())
            ->get("interested_in");

        $feed = Extended_User::
            where([
                ['user_id', '!=', Auth::id()],
                ['gender', '=', $interestedIn[0]["interested_in"]]
            ])
            ->with("User")
            ->get();

        return response()->json([
            "status" => "success",
            "message" => $feed
        ]);
    }

    public function profile() {
        $profile = Extended_User::
            where("user_id", Auth::id())
            ->with("User")
            ->get();

        return response()->json([
            "status" => "success",
            "message" => $profile
        ]);
    }
}
