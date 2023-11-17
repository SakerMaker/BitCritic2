<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use MarcReichel\IGDBLaravel\Enums\Image\Size;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Genre;

class GameController extends Controller
{
    public function index() {
        return view('games');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $igdb = new IGDB("games");
        $game = $igdb->find($id);
        if (isset($game["cover"])) {
            $cover = Cover::find($game["cover"]);
            $game["cover_url"] = $cover->getUrl(Size::COVER_BIG, true);
        } else {
            $game["cover_url"] = "img/BitCritic-No-Game-Cover-View-Game-Review-Community-S.png";
        }
        if (isset($game["genres"])) {
            for ($i = 0;$i<count($game["genres"]);$i++) {
                $genres[$i]=Genre::select(["name"])->find($game["genres"][$i]);
                $genres[$i]=$genres[$i]->name;
            }
            $game["genres"]=array_unique($genres);
        }


        $reviews=Review::all()->where("id_game","=",$id);
        $users=array();
        foreach ($reviews as $single_review) {
            $users[]=User::join("reviews","users.id","=","reviews.id_user")->select("users.id as id","users.name as name","users.profile_photo_path as profile_photo_path","reviews.id as id_review","reviews.title as review_title","reviews.content as review_content","reviews.created_at as created_at","reviews.updated_at as updated_at")->where("reviews.id","=",$single_review->id)->groupBy("users.id")->get();
        }

        $review_count=count($reviews);

        return view('games.index')->with("game",$game)->with("reviews",$users)->with("review_count",$review_count);
    }
}
