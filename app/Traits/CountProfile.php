<?php

namespace App\Traits;

use App\Models\Comment;
use App\Models\Follows;
use App\Models\Like;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

trait CountProfile {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public static function follow_count(User $user) {
        $followers=Follows::where("id_user_followed",$user->id)->get()->count();

        return $followers;
    }
    public static function likes_count(User $user) {
        $likes=Like::where("id_user",$user->id)->get()->count();

        return $likes;
    }
    public static function comments_count(User $user) {
        $comments=Comment::where("id_user",$user->id)->get()->count();

        return $comments;
    }
    public static function reviews_count(User $user) {
        $reviews=Review::where("id_user",(int)$user->id)->get()->count();

        return $reviews;
    }

}