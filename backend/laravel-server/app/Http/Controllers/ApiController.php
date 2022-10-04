<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Extended_User;
use Illuminate\Support\Facades\Auth;
use File;

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

        $fileName = "images/" . $profile[0]["user"]["photo"];

        $photo = File::get(public_path($fileName));
        // $profile[0]["user"]["photo"] = $photo;

        return response()->json([
            "status" => "success",
            "message" => $photo
        ]);
    }

    public function profile_edit(Request $request) {
        if($request->photo) {
            $request->validate([
                "photo" => "mimes:jpg,jpeg,png"
            ]);

            $photoName = time() . "-" . Auth::id() . "." . $request->photo->extension();
            $request->photo->move(public_path("images"), $photoName);
        };



        $user = User::find(Auth::id());
        $extUser = Extended_User::find(Auth::id());
        $profile = Extended_User::
            where("user_id", Auth::id())
            ->with("User")
            ->get();

        $user->name = $request->name ? $request->name : $profile[0]["user"]["name"];
        $user->photo = $request->photo ? $photoName : $profile[0]["user"]["photo"];
        $extUser->age = $request->age ? $request->age : $profile[0]["age"];
        $extUser->biography = $request->bio ? $request->bio : $profile[0]["biography"];
        $extUser->gender = $request->gender ? $request->gender : $profile[0]["gender"];
        $extUser->interested_in = $request->interested_in ? $request->input("interested_in") : $profile[0]["interested_in"];

        $user->save();
        $extUser->save();

        return response()->json([
            "status" => "success",
            "message" => $photoName
        ]);
    }
}
