<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use MarcReichel\IGDBLaravel\Enums\Image\Size;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Genre;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $allReviews = Review::all();

        request()->validate(Review::$rules);

        $comprobar=true;
        foreach ($allReviews as $comprobarReview){
            if($comprobarReview->id_game==$request->id_game && $comprobarReview->id_user==$request->id_user){
                $comprobar=false;
            }
        }

        if($comprobar){
            $review = Review::create($request->all());
            if(isset($_REQUEST['reviewUsuario'])){
                return redirect()->back();
            }else{
                return redirect()->back()
                ->with('success', 'Review created successfully.');
            }
        }else{
            if(isset($_REQUEST['reviewUsuario'])){
                return redirect()->back()
                ->with('error', 'Un usuario no puede crear más de una review por juego.');
            }else{
                return redirect()->back()
            ->with('error', 'Un usuario no puede crear más de una review por juego.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review=Review::findOrFail($id);
        $user = User::findOrFail($review->id_user);
        $comments=Comment::all()->where("id_review","=",$id);
        $users=array();
        foreach ($comments as $single_comment) {
            $users[]=User::join("comments","users.id","=","comments.id_user")->select("users.id as id","users.name as name","users.profile_photo_path as profile_photo_path","comments.id as id_commnent","comments.content as comment_content","comments.created_at as created_at","comments.updated_at as updated_at")->where("comments.id","=",$single_comment->id)->groupBy("users.id")->get();
        }


        $igdb = new IGDB("games");
        $game = $igdb->find($review->id_game);
        if (isset($game["genres"])) {
            for ($i = 0;$i<count($game["genres"]);$i++) {
                $genres[$i]=Genre::select(["name"])->find($game["genres"][$i]);
                $genres[$i]=$genres[$i]->name;
            }
            $game["genres"]=array_unique($genres);
        }
        if (isset($game["cover"])) {
            $cover = Cover::find($game["cover"]);
            $game["cover"] = $cover->getUrl(Size::COVER_BIG, true);
        } else {
            $game["cover"]="img/BitCritic-No-Game-Cover-View-Game-Review-Community-S.png";
        }


        return view('reviews.index', compact('review'))->with("users",$users)->with("game",$game)->with("user",$user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::find($id)->delete();

        if(isset($_REQUEST['reviewUsuario'])){
            return redirect()->route('index')
            ->with('success', 'Review deleted successfully');
        }else{
            return redirect()->route('index')
            ->with('success', 'Review deleted successfully');
        }
    }
}
