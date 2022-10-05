<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Extended_User;
use Illuminate\Support\Facades\Auth;
use File;

class ApiController extends Controller {

    private function imageHandler($path) {
        $filePath = public_path("images\\" . $path);
        $photo = base64_encode(file_get_contents($filePath));
        return "data:image/png;base64," . $photo;
    }
    
    public function register(Request $request) {
        $newUser = new User;
        $extendedUser = new Extended_User;

        $newUser->username = $request->input("username");
        $newUser->password = bcrypt($request->input("password"));
        $newUser->name = $request->input("name");
        $newUser->user_type = "2";
        $newUser->save();

        $extendedUser->location = $request->input("location");
        $extendedUser->latitude = $request->input("latitude");
        $extendedUser->longitude = $request->input("longitude");
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

        foreach ($feed as $f) {
            if($f["user"]["photo"]) {
                $f["user"]["photo"] = self::imageHandler($f["user"]["photo"]);
            }
        }
        
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

        if($profile[0]["user"]["photo"]) {
            $profile[0]["user"]["photo"] = self::imageHandler($profile[0]["user"]["photo"]);
        }
        
        return response()->json([
            "status" => "success",
            "message" => $profile
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

    public function favorites() {   
        $followings = User::whereHas('followers', function ($query) {
            return $query->where('follower_id', '=', Auth::id());
        })->with("Extended_User")->get();

        foreach ($followings as $f) {
            if($f["photo"]) {
                $f["photo"] = self::imageHandler($f["photo"]);
            }
        }

        return response()->json([
            "status" => "success",
            "message" => $followings
        ]);
    }
}
