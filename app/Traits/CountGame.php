<?php

namespace App\Traits;

use App\Models\Comment;
use App\Models\Follows;
use App\Models\Like;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

trait CountGame {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public static function reviews_count($id) {
        $reviews=Review::where("id_game",(int)$id)->get()->count();

        return $reviews;
    }

}