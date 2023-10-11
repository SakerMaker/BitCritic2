<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follows;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\CountProfile;

class UserController extends Controller
{
    use CountProfile;

    public function show($name) {
        $user=User::where('name', $name)->firstOrFail();
        $followers=CountProfile::follow_count($user);
        $likes=CountProfile::likes_count($user);
        $comments=CountProfile::comments_count($user);
        $reviews=CountProfile::reviews_count($user);
        return view('user.profile', compact('user', "followers", "likes", "comments", "reviews"));
    }
}
