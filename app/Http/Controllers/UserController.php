<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\CountProfile;
use Illuminate\Support\Facades\Auth;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use MarcReichel\IGDBLaravel\Models\Genre;
use App\Traits\CountGame;
use MarcReichel\IGDBLaravel\Enums\Image\Size;
use MarcReichel\IGDBLaravel\Models\Cover;

class UserController extends Controller
{
    
    use CountProfile;

    public function show($name) {
        $igdb = new IGDB("games");
        $user=User::where('name', $name)->firstOrFail();

        if (isset($user->birthday) && NULL !== $user->birthday) {
            $birthday=strtotime($user->birthday);
            $user->birthday=date('d M. Y',$birthday);
        }

        if (NULL === $user->about_me) {
            $user->about_me="Este usuario aún no ha escrito nada...";
        }

        $allreviews=Review::all()->where("id_user","=",$user->id);
        $games=[];
        if (!empty($allreviews->toArray())) {

            $games_id=[];
            foreach ($allreviews as $review) {
                $games_id[]=$review->id_game;
            }
            $games=$igdb->whereIn("id",$games_id)->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take(count($games_id))->get();


            if ($games!=NULL) {
                $contador=0;
                foreach ($games as $game) {
                    if (isset($game["genres"])) {
                        for ($i = 0;$i<count($game["genres"]);$i++) {
                            $genres[$i]=Genre::select(["name"])->find($game["genres"][$i]);
                            $genres[$i]=$genres[$i]->name;
                        }
                        $games[$contador]["genres"]=array_unique($genres);
                    }
                    $games[$contador]["reviews"]=CountGame::reviews_count($game["id"]);
                    if (isset($game["cover"])) {
                        $covers["cover"][]=$game["id"];
                        $games[$contador]["hasCover"]=true;
                    } else {
                        $covers["cover"][]=0;
                        $games[$contador]["cover"]="img/BitCritic-No-Game-Cover-View-Game-Review-Community-S.png";
                        $games[$contador]["hasCover"]=false;
                    }
                    $contador++;
                }
            }
            $allCovers = Cover::whereIn("game", $covers["cover"])->take(count($covers["cover"]))->get();
            
            foreach ($allCovers as $cover) {
                $contador=0;
                foreach ($games as $game) {
                    if ($game["hasCover"] && $game["id"] == $cover["game"]) {
                        $games[$contador]["cover"]=$cover->getUrl(Size::COVER_BIG, true);
                    }
                    $contador++;
                }
            }
        }
        
        $allreviews = $allreviews->toArray();

        $temp = array_column($allreviews, "id_game");
        array_multisort($temp, SORT_ASC, $allreviews);
        
        $contador=0;
        foreach ($allreviews as $review) {
            $allreviews[$contador]["games"]=$games[$contador];
            $contador++;
        }

        $temp = array_column($allreviews, "updated_at");
        array_multisort($temp, SORT_DESC, $allreviews);

        // $followers=CountProfile::follow_count($user);
        $posts = Review::where("id_user",$user->id)->withCount('likers')->get();
        $likes=0;
        foreach($posts as $post) {
            $likes+=$post->likers_count;
        }
        $comments=CountProfile::comments_count($user);
        $reviews=CountProfile::reviews_count($user);
        return view('user.profile', compact('user', "likes", "comments", "reviews", "allreviews"));
    }

    public function edit($name) {
        $user=User::where('name', $name)->firstOrFail();
        $likes=$user->totalLikes;
        $comments=CountProfile::comments_count($user);
        $reviews=CountProfile::reviews_count($user);
        return view('user.edit', compact('user', "likes", "comments", "reviews"));
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
            $filename = time() . "-" . urlencode($file->getClientOriginalName());
            $uploadSuccess = $request['profile_photo_path']->move($destinationPath, $filename);
            $user->profile_photo_path="profile-photos/" . urlencode($filename);
        }

        if ($request->hasFile('banner_photo_path')) {
            $file = $request['banner_photo_path'];
            $destinationPath = "storage/banner-photos/";
            $filename = time() . "-" . urlencode($file->getClientOriginalName());
            $uploadSuccess = $request['banner_photo_path']->move($destinationPath, $filename);
            $user->banner_photo_path="banner-photos/" . urlencode($filename);
        }
        
        $user->update();

        return redirect()->route('user.profile',Auth::user()->name);
        
    }
}
