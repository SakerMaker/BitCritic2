<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Models\User;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Genre;
use App\Traits\CountGame;
use MarcReichel\IGDBLaravel\Enums\Image\Size;

class UserReviews extends Component
{
    public $following;
    public $user;
    public $page;
    public $skip;
    public $perPage;
    public $canLoadMore;
    public $globalReviews;

    public function mount($user, $perPage=12, $canLoadMore = true, $globalReviews = []) {
        $this->user=User::find($user);
        $this->perPage = $perPage;
        $this->canLoadMore = $canLoadMore;
        $this->globalReviews = $globalReviews;
    }

    public function nextPage() {
        $this->page = $this->page+1;
        
    }

    public function render()
    {
        $this->canLoadMore=true;
        
        $igdb = new IGDB("games");
        $allreviews=Review::where("id_user",$this->user->id)->orderByDesc("updated_at")->take((int)$this->perPage)->skip((int)$this->perPage*(int)$this->page)->get();
        $games=[];
        if (!empty($allreviews->toArray())) {
            
            $games_id=[];
            foreach ($allreviews as $review) {
                $games_id[]=$review->id_game;
            }
            $games=$igdb->whereIn("id",$games_id)->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take(count($allreviews))->get();
            
            $covers["cover"]=[];
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
            $allCovers = Cover::whereIn("game", $covers["cover"])->take(count($allreviews))->get();
            
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
        if (count($allreviews)<$this->perPage) {
            $this->canLoadMore=false;
        }
        


        $allreviews = $allreviews->toArray();

        $contador=0;
        foreach ($allreviews as $review) {
            $allreviews[$contador]["likes"]=Review::find($review["id"])->totalLikers;
            $contador++;
        }

        $temp = array_column($allreviews, "id_game");
        array_multisort($temp, SORT_ASC, $allreviews);
        
        $contador=0;
        foreach ($allreviews as $review) {
            $allreviews[$contador]["games"]=$games[$contador];
            $contador++;
        }

        $temp = array_column($allreviews, "updated_at");
        array_multisort($temp, SORT_DESC, $allreviews);
        

        $this->globalReviews[]=$allreviews;
        return view('livewire.user-reviews')->with("allreviews",$this->globalReviews);
    }
}
