<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follows;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\CountProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use CountProfile;

    public function show($name) {
        $user=User::where('name', $name)->firstOrFail();

        if (isset($user->birthday) && NULL !== $user->birthday) {
            $birthday=strtotime($user->birthday);
            $user->birthday=date('d M. Y',$birthday);
        }

        if (NULL === $user->about_me) {
            $user->about_me="Este usuario aún no ha escrito nada...";
        }

        $followers=CountProfile::follow_count($user);
        $likes=CountProfile::likes_count($user);
        $comments=CountProfile::comments_count($user);
        $reviews=CountProfile::reviews_count($user);
        return view('user.profile', compact('user', "followers", "likes", "comments", "reviews"));
    }

    public function edit($name) {
        $user=User::where('name', $name)->firstOrFail();
        $followers=CountProfile::follow_count($user);
        $likes=CountProfile::likes_count($user);
        $comments=CountProfile::comments_count($user);
        $reviews=CountProfile::reviews_count($user);
        return view('user.edit', compact('user', "followers", "likes", "comments", "reviews"));
    }

    public function update(Request $request, $id)
    {
        request()->validate(User::$rules);

        $user = User::find($id);
        $user->location=$request->input("location");
        $user->birthday=$request->input("birthday");
        $user->about_me=$request->input("about_me");

        if ($request->hasFile('profile_photo_path')) {
            $file = $request['profile_photo_path'];
            $destinationPath = "storage/profile-photos/";
            $filename = time() . "-" . $file->getClientOriginalName();
            $uploadSuccess = $request['profile_photo_path']->move($destinationPath, $filename);
            $user->profile_photo_path="profile-photos/" . $filename;
        }

        if ($request->hasFile('banner_photo_path')) {
            $file = $request['banner_photo_path'];
            $destinationPath = "storage/banner-photos/";
            $filename = time() . "-" . $file->getClientOriginalName();
            $uploadSuccess = $request['banner_photo_path']->move($destinationPath, $filename);
            $user->banner_photo_path="banner-photos/" . $filename;
        }
        
        $user->update();

        return redirect()->route('user.profile',Auth::user()->name);
        
    }
    
}
